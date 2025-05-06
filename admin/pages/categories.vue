<!-- pages/about.vue -->
<template>
  <Table :columns="columns" :data-source="data" :pagination="pagination" :row-key="'id'" :show-header="true">
    <template #bodyCell="{ column, record }">
      <div v-if="column.dataIndex === 'status'">
        <component :is="record.status === 1 ? EyeTwoTone : EyeInvisibleTwoTone" style="font-size: 20px; cursor: pointer;" @click="handleStatusClick(record)" />
      </div>
    </template>
  </Table>
</template>

<script setup>
import Table from 'ant-design-vue/es/table/Table';
import { EyeTwoTone,  EyeInvisibleTwoTone } from '@ant-design/icons-vue';
// const sakeListStore = useSakeListStore()

const fetchData = async () => {
  // Simulate an API call to fetch data

};

onMounted(() => {
  // Fetch data from API or perform any other setup
});

// Sample JSON data for the table
const data = [
  {
    id: '1',
    name: 'Category 1',
    description: 'Description for Category 1',
    position: 1,
    status: 1,
  },
  {
    id: '2',
    name: 'Category 2',
    description: 'Description for Category 2',
    position: 2,
    status: 0,
  },
  {
    id: '3',
    name: 'Category 3',
    description: 'Description for Category 3',
    position: 3,
    status: 1
  },
];

// Columns configuration for the table
const columns = [
  {
    title: 'ID',
    dataIndex: 'id',
    key: 'id',
  },
  {
    title: 'Name',
    dataIndex: 'name',
    key: 'name',
  },
  {
    title: 'Description',
    dataIndex: 'description',
    key: 'description',
  },
  {
    title: 'Position',
    dataIndex: 'position',
    key: 'position',
  },
  {
    title: 'Status',
    dataIndex: 'status',
    key: 'status',
    // customRender: ({ text, record }) => {
    //   const icon = text === 1 ? EyeTwoTone : EyeInvisibleTwoTone;
    //   return h(icon, {
    //     style: { fontSize: '20px', cursor: 'pointer' },
    //     onClick: () => handleStatusClick(record),
    //   });
    // },
    width: '10%',
    align: 'center',
  },
];

// Pagination configuration
const pagination = {
  pageSize: 2,
  current: 1,
  total: data.length,
};
const handleStatusClick = (record) => {
  console.log('Clicked record:', record);
  // TODO: làm gì đó, ví dụ toggle trạng thái
};
</script>
