<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import Header from '../Components/Header.vue';
import Footer from '../Components/Footer.vue';

defineProps({
    fullColor: {
      type: Boolean,
      default: true
    }
  });
</script>

<template>
  <div class="font-secondary">
    
    <head title="hola" />
    <Header :fullColor="fullColor" />
    <slot></slot>
    <Footer />
  </div>
</template>
