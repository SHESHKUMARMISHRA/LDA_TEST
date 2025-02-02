<script setup lang="ts">
import Hero from '@/Components/Dashboard/Hero.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';

// Define the interface for a job object
interface Job {
  id: number;
  title: string;
  company_name: string;
  company_logo: string;
  job_type: string;
  description: string;
  experience: string;
  salary: string;
  location: string;
  skills: string[]; // Assuming skills is an array of strings
}

// Use ref to store the jobs array with the Job type
const jobs = ref<Job[]>([]);

// Fetch jobs when the component mounts
onMounted(() => {
  const pageProps = usePage();
  jobs.value = (pageProps.props.jobs as Job[]); // Type assertion to specify jobs is of type Job[]
});
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <!-- Hero -->
    <Hero />

    <!-- Job List -->
    <div class="bg-white">
      <div class="container py-5">
        <!-- Job List -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <!-- Loop through jobs dynamically -->
          <div v-for="job in jobs" :key="job.id" class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">
            <div class="p-4">
              <div class="flex justify-between items-center">
                <!-- Company Info -->
                <div class="flex items-center space-x-2">
                  <img :src="job.company_logo" alt="Company Logo" class="h-10 w-10 object-cover rounded-full" />
                  <div>
                    <h3 class="text-xl font-semibold text-gray-800">{{ job.company_name }}</h3>
                    <p class="text-sm text-gray-500">{{ job.job_type }}</p>
                  </div>
                </div>
                <!-- Job Type -->
                <span class="px-3 py-1 text-xs font-medium bg-blue-100 text-blue-600 rounded-full">{{ job.job_type }}</span>
              </div>

              <h4 class="mt-3 text-xl font-semibold text-gray-900">{{ job.title }}</h4>
              <p class="text-sm text-gray-600 mt-2">{{ job.description }}</p>

              <div class="mt-4 text-sm text-gray-500 space-y-2">
                <p><strong>Experience:</strong> {{ job.experience }}</p>
                <p><strong>Salary:</strong> {{ job.salary }}</p>
                <p><strong>Location:</strong> {{ job.location }}</p>
              </div>
            </div>

            <!-- Skills List -->
            <div class="px-4 py-3 bg-gray-50 text-left">
              <span class="text-sm font-medium text-gray-700">Skills:</span>
              <div class="flex flex-wrap gap-2 mt-2">
                <span v-for="skill in job.skills" :key="skill" class="bg-gray-200 text-gray-800 text-xs px-3 py-1 rounded-full">
                  {{ skill }}
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
