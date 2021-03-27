<template>
  <v-sheet>
    <v-app-bar app color="white" elevation="0">
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
      <v-spacer />

      <div class="user-box">
        <v-tooltip bottom>
          <template v-slot:activator="{ on, attrs}">
            <v-avatar
              v-bind="attrs"
              v-on="on"
              class="mr-3 pointer"
              color="deep-purple"
              size="34">

              <span class="white--text headline"> A </span>
            </v-avatar>
          </template>

          <span> Administrator</span>
        </v-tooltip>

        <SharedButton color="deep-purple" content="Logout"/>
      </div>
    </v-app-bar>

    <v-navigation-drawer app floating v-model="drawer" :permanent="drawer">
      <div class="pt-5 pb-2 text-center">
        <img width="50" src="/brand.webp" alt="">
        <h3 class="mt-3 font-weight-regular">Dashboard</h3>
      </div>

      <v-list dense @click.stop="drawer = !drawer">
        <v-divider class="mb-5"></v-divider>

        <v-list-item
          v-for="(item, index) in links"
          link
          :to="item.link"
          class="px-4 py-1 custom-link-color"
          :key="index + '__items_navbar'"
        >
          <v-list-item-icon>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-icon>

          {{ item.title }}
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
  </v-sheet>
</template>

<script>
import { ref } from "@nuxtjs/composition-api";

export default {
  name: "clientNavbar",

  setup() {
    const drawer = ref(null);

    const links = [
      { title: "Administrators", icon: "mdi-account-group", link: "/administrators" },
      { title: "Companies", icon: "mdi-domain", link: "/companies" },
      { title: "Agents", icon: "mdi-face-agent", link: "/agents" },
    ];

    return { drawer, links };
  },
};
</script>
