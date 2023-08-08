<template>
    <nav class="w-full p-3 mt-3">
        <ul
            class="flex flex-col item content-center text-xl gap-y-3"
        >
            <li>
                <RouterLink to="/all">All Items</RouterLink>
            </li>
            <li>
                <RouterLink to="/login">Login</RouterLink>
            </li>
            <li>
                <RouterLink to="/card">Card</RouterLink>
            </li>
            <li>
                <RouterLink to="/identity">Identity</RouterLink>
            </li>
        </ul>
    </nav>
</template>

<script setup>

</script>

<style scoped>
a.active {
  color: blue;
  font-weight: 700;
  padding-bottom: 4px;
  border-bottom: 2px solid #CED4DA;
  border-radius: 2px;
}
</style>
