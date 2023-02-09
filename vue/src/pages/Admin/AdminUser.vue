<template>
  <div class="row">
    <div class="col-12">
      <card :title="table1.title">
        <div class="table-responsive">
          <base-table
            :data="table1.data"
            :columns="table1.columns"
            thead-classes="text-primary"
          >
          </base-table>
        </div>
      </card>
    </div>
  </div>
</template>
<script>
import { BaseTable } from "@/components";
const tableColumns = ["Name", "Role", "Username"];
const tableData = [
  {
    id: 1,
    name: "Wahyu",
    role: "Admin",
    username: "WahyuAdmin123",
  },
];

export default {
  components: {
    BaseTable,
  },
  data() {
    return {
      table1: {
        title: "Manage User",
        columns: [...tableColumns],
        data: [...tableData],
      },
      table2: {
        title: "Table on Plain Background",
        columns: [...tableColumns],
        data: [...tableData],
      },
    };
  },
};
</script>
<style></style>
