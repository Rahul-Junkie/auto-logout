<template>
  <div
    class="overflow-hidden overflow-x-auto min-w-full align-middle sm:rounded-md"
  >
    <h6>Registered Users</h6>
    <table class="min-w-full border divide-y divide-gray-200">
      <thead>
        <tr>
          <th class="px-6 py-3 bg-gray-50">
            <span
              class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase"
              >Name</span
            >
          </th>
          <th class="px-6 py-3 bg-gray-50">
            <span
              class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase"
              >Email</span
            >
          </th>
          <th class="px-6 py-3 bg-gray-50"></th>
        </tr>
      </thead>

      <tbody class="bg-white divide-y divide-gray-200 divide-solid">
        <template v-for="item in users" :key="item.id">
          <tr class="bg-white">
            <td
              class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap"
            >
              {{ item.name }}
            </td>
            <td
              class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap"
            >
              {{ item.email }}
            </td>
            <td
              class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap"
            >
              <button
              v-if="users.length>1"
                @click="deleteUser(item.id)"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
              >
                Delete
              </button>
            </td>
          </tr>
        </template>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import useUsers from "@/composables/users";
import { onMounted } from "vue";

const { users, getUsers, destroyUsers } = useUsers();
onMounted(getUsers);
const deleteUser = async (id) => {
  if (!window.confirm("Are you sure?")) {
    return;
  }
  await destroyUsers(id);
  await getUsers();
};
</script>
