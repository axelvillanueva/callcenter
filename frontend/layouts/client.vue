<template>
  <v-app>
    <v-main>
      <ClientNavbar />

      <v-container class="fill-height px-4 app-wrapper" fluid>
        <v-row class="fill-height">
          <transition name="fade">
            <Nuxt />
          </transition>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>
