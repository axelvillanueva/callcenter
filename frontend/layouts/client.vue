<template>
  <v-app>
    <main>
      <ClientNavbar />

      <v-container>
        <v-row>
          <v-col>
            <transition name="fade">
              <Nuxt />
            </transition>
          </v-col>
        </v-row>
      </v-container>
    </main>
  </v-app>
</template>

<script>
import ClientNavbar from '~/components/client/ClientNabvar';

export default {
  components: {
    ClientNavbar
  }
}
</script>
