<template>
    <v-data-table :headers="headers" :items="users" :sort-by="[{ key: 'calories', order: 'asc' }]"   style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
        <template v-slot:top>
            <v-toolbar flat style="background-color: #2e3b45;">
                <v-toolbar-title style="color: white;">Users</v-toolbar-title>
                <v-divider class="mx-4" inset vertical></v-divider>
                <v-spacer></v-spacer>
                <v-dialog v-model="dialog" max-width="500px">
                    <template v-slot:[`activator`]="{ props }">
                        <v-btn style="background-color: #ea560d; color: white;" class="mb-2" v-bind="props">
                            Ajouter
                        </v-btn>
                    </template>
                    <v-card>
                        <v-card-title>
                            <span class="text-h5">{{ formTitle }}</span>
                        </v-card-title>

                        <v-card-text>
                            <v-container>
                                <v-row>
                                    <v-col cols="12" sm="6" md="4">
                                        <v-text-field v-model="editedItem.name" label="Name"></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6" md="4">
                                        <v-text-field v-model="editedItem.description" label="Description"></v-text-field>
                                    </v-col>
                                  
                                </v-row>
                            </v-container>
                        </v-card-text>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="#2e3b45" variant="text" @click="close">
                                Cancel
                            </v-btn>
                            <v-btn color="#2e3b45" variant="text" @click="save">
                                Save
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
                <v-dialog v-model="dialogDelete" max-width="500px">
                    <v-card>
                        <v-card-title class="text-h5">Are you sure you want to delete ?</v-card-title>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="#2e3b45" variant="text" @click="closeDelete">Cancel</v-btn>
                            <v-btn color="#2e3b45" variant="text" @click="deleteItemConfirm">OK</v-btn>
                            <v-spacer></v-spacer>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-toolbar>
        </template>
        <template v-slot:[`item.actions`]="{ item }">
            <v-icon size="small" class="me-2" @click="editItem(item)">
                mdi-pencil
            </v-icon>
            <v-icon size="small" @click="deleteItem(item)">
                mdi-delete
            </v-icon>
        </template>
        <template v-slot:no-data>
            
        </template>
    </v-data-table>
</template>
  
<script>
export default {
    data: () => ({
        dialog: false,
        dialogDelete: false,
        headers: [
            {
                title: 'ID',
                align: 'start',
                sortable: false,
                key: 'id',
            },
            { title: 'Name', key: 'name' },
            { title: 'Description', key: 'description' },
            { title: 'Actions', key: 'actions', sortable: false },
           
        ],
        users: [],
        editedIndex: -1,
        editedItem: {
            id: '',
            name: '',
            description: '',
          
        },
        defaultItem: {
            id: '',
            name: '',
            description: '',
        },
    }),

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? 'New User' : 'Edit User'
        },
    },

    watch: {
        dialog(val) {
            val || this.close()
        },
        dialogDelete(val) {
            val || this.closeDelete()
        },
    },

    created() {
        this.initialize()
    },

    methods: {
        initialize() {
  this.users = [
    { 
      id: 1, 
      name: 'Alice Johnson', 
      description: 'Passionate fullstack developer .'
    },
    { 
      id: 2, 
      name: 'Bob Smith', 
      description: 'Detail-oriented fullstack developer .'
    },
    { 
      id: 3, 
      name: 'Eva Martinez', 
      description: 'Creative fullstack developer .'
    },
    { 
      id: 4, 
      name: 'Charlie Brown', 
      description: 'Experienced fullstack developer '
    },
    { 
      id: 5, 
      name: 'Grace Lee', 
      description: 'Innovative fullstack developer '
    },
   
  ];
},
        editItem(item) {
            this.editedIndex = this.users.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog = true
        },

        deleteItem(item) {
            this.editedIndex = this.users.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialogDelete = true
        },

        deleteItemConfirm() {
            this.users.splice(this.editedIndex, 1)
            this.closeDelete()
        },

        close() {
            this.dialog = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },

        closeDelete() {
            this.dialogDelete = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },

        save() {
            if (this.editedIndex > -1) {
                Object.assign(this.users[this.editedIndex], this.editedItem)
            } else {
                this.users.push(this.editedItem)
            }
            this.close()
        },
    },
}
</script>