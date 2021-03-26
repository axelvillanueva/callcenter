<template>
  <v-app>
    <v-main>
      <ClientNavbar />

      <v-container class="fill-height px-4 app-wrapper" fluid>
        <v-row class="fill-height">
          <v-col>
            <transition name="fade">
              <Nuxt />
            </transition>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>
