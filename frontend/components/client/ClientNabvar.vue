<template>
  <v-sheet>
    <v-app-bar app color="white" elevation="0">
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
      <v-toolbar-title> Dashboard </v-toolbar-title>
      <v-spacer />

      <Button color="deep-purple" content="Logout" />
    </v-app-bar>

    <v-navigation-drawer>
      <div class="pt-2 pb-2 text-center">
        <v-avatar color="deep-purple" size="62">
          <span class="white--text headline"> A </span>
        </v-avatar>

        <h3 class="mt-3 font-weigth-regular">Administrators</h3>
      </div>

      <v-list dense @click.stop="drawer = !drawer">
        <v-divider class="mb-5"></v-divider>

        <v-list-item
          link
          to="/admins"
          class="px-4 py-1"
          v-for="(item, index) in links"
          :key="index + '__items_nabvar'"
        >
          <v-list-item-icon>
            <v-icon>
              {{ item.icon }}
            </v-icon>
          </v-list-item-icon>
          {{ item.title }}
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
  </v-sheet>
</template>

<script>
import { reactive, ref } from "@nuxtjs/composition-api";

export default {
  name: "clientNavbar",

  setup() {
    const drawer = ref(null);

    const links = reactive([
      { title: "Administrators", icon: "mdi-account-group" },
      { title: "Companies", icon: "mdi-domain" },
      { title: "Agents", icon: "mdi-face-agent" },
    ]);

    return { drawer, links };
  },
};
</script>
