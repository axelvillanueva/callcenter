<template>
  <v-col>
    <v-text-field
      v-model="search"
      append-icon="mdi-magnify"
      label="Type of search"
      single-line
      solo
      color="deep-purple"
      hide-details
      class="py-3"
    >
    </v-text-field>

    <v-data-table
      :headers="headers"
      :items="records"
      :search="search"
      :item-per-page="5"
      :loading="isLoading"
      color="deep-purple"
      loading-text="Loading... Please wait"
      class="elevation-3"
    >
      <template>
        <v-switch color="deep-purple" value="deep-purple" />
      </template>

      <template v-slot:item.options="{ item }">
        <v-tooltip bottom>
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              class="mr-2"
              v-bind="attrs"
              v-on="on"
              fab
              small
              color="light"
              elevation="0"
            >
              <v-icon class="deep-purple--text">mdi-pencil</v-icon>
            </v-btn>
          </template>

          <span>Modify element</span>
        </v-tooltip>

        <v-tooltip bottom>
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              v-bind="attrs"
              v-on="on"
              fab
              small
              color="light"
              elevation="0"
            >
              <v-icon class="red--text">mdi-delete</v-icon>
            </v-btn>
          </template>

          <span>Remove item</span>
        </v-tooltip>
      </template>
    </v-data-table>
  </v-col>
</template>

<script>
import { ref } from '@nuxtjs/composition-api';

export default {
  layout: "client",

  setup() {
    const search = ref(null);
    const isLoading = ref(null);

    const records = ref([
      {name: "Administrator", email: "admin@viba.com", created_at: "06/01/2021"},
      {name: "Axel Villanueva", email: "axelvillanueva36@gmail.com", created_at: "07/09/1997"}
    ]);

    const headers = ref([
      { text: 'Name', align: 'start', sortable: true, value: 'name' },
      { text: 'Email', align: 'start', sortable: true, value: 'email' },
      { text: 'Created at', align: 'start', sortable: true, value: 'created_at' },
      { text: 'Status', align: 'start', sortable: true, value: 'status' },
      { text: 'Options', align: 'start', sortable: false, value: 'options'}
    ]);

    return { headers, records, isLoading, search};
  }
};
</script>
