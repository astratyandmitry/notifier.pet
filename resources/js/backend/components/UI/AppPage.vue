<script setup></script>

<template>
  <section class="page">
    <header>
      <h3><slot name="title" /></h3>

      <slot name="actions" />
    </header>

    <main>
      <slot />
    </main>
  </section>
</template>

<style lang="postcss" scoped>
header {
  @apply flex items-center justify-between mb-6 space-x-8;
}

h3 {
  @apply text-3xl font-semibold;
}
</style>
