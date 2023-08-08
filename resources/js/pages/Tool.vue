<template>
    <div class="max-w-6xl mx-auto">
        <div class="flex flex-row gap-x-3 mt-6">
            <div class="flex-none w-72 h-[300px] border-2 border-gray-300 rounded-md">
              <h3 class="block text-left text-2xl pl-3 py-2 bg-gray-100 font-semibold border-b-2 uppercase border-gray-300">Tools</h3>
                <nav class="w-full p-3">
                    <ul class="flex flex-col item text-xl content-center gap-y-3">
                        <li>
                            <RouterLink to="/tools/generator">Generator</RouterLink>
                        </li>
                        <li>
                            <RouterLink to="/tools/export">Export Data</RouterLink>
                        </li>
                        <li>
                            <RouterLink to="/tools/import">Import Data</RouterLink>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="flex-auto border rounded-md">
                <RouterView></RouterView>
            </div>
        </div>
    </div>
</template>

<script setup>
import { RouterView } from 'vue-router';
</script>

<style scoped>
a.active {
  color: blue;
  font-weight: 700;
  padding-bottom: 4px;
  border-bottom: 2px solid #CED4DA;
}
</style>

