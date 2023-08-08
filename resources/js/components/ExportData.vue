<template>
  <div class="p-4 bg-white rounded-lg shadow">
    <label class="block mb-2 text-lg font-semibold">Select Format:</label>
    <select v-model="selectedFormat" class="block w-full p-2 border border-gray-300 rounded">
      <option value="json">JSON</option>
      <option value="csv">CSV</option>
    </select>
    <button @click="exportData" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">
      Export Data
    </button>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useUserStore } from '../store/UserStore';

const store = useUserStore();

// Data to be exported
const allData = ref([]);

// Selected format for export
const selectedFormat = ref('json');


// Function to fetch data from API
const fetchData = async () => {
    try {
        const response = await axios.get("/api/vault/all", {
            headers: {
                Authorization: `Bearer ${store.token}`,
            },
        });
        const formattedData = [
            ...response.data.logins,
            ...response.data.cards,
            ...response.data.identities,
        ];
        allData.value = formattedData;

    } catch (error) {
        console.error(error);
    }
}      

// Function to convert data to JSON
const convertToJson = (data) => JSON.stringify(data, null, 2);


// Function to convert data to CSV
const convertToCsv = (data) => {
  // Prepare the CSV header row
  const headers = Object.keys(data[0]);
  const csvHeader = headers.join(",") + "\n";

  // Convert each data row to a CSV row
  const csvRows = data.map((row) => {
    const values = Object.values(row);
    return values.map((value) => `"${value}"`).join(",");
  });

  // Combine the header row and CSV rows into a single CSV string
  const csvContent = csvHeader + csvRows.join("\n");
  return "data:text/csv;charset=utf-8," + csvContent;
};


// Function to trigger download based on selected format
const exportData = () => {
  // Get the selected format
  const format = selectedFormat.value;

  if (format === 'json') {
    // Convert data to JSON
    const jsonData = convertToJson(allData.value);
    downloadFile(jsonData, 'exported_data.json');
  } else if (format === 'csv') {
    // Convert data to CSV
    const csvData = convertToCsv(allData.value);
    downloadFile(csvData, 'exported_data.csv');
  }
};


// Function to create a link element and trigger download
const downloadFile = (content, filename, mimeType) => {
  const blob = new Blob([content], { type: mimeType });
  const url = URL.createObjectURL(blob);

  const link = document.createElement("a");
  link.href = url;
  link.download = filename;
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
  URL.revokeObjectURL(url);
};


// Fetch data when the component is mounted
onMounted(() => {
    fetchData();
})
</script>

