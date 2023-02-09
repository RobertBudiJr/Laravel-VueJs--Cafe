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
const tableColumns = ["Nomor_Meja", "Status"];
const tableData = [
  {
    id: 1,
    nomor_meja: 21,
    status: "Kosong",
  },
];

export default {
  components: {
    BaseTable,
  },
  data() {
    return {
      table1: {
        title: "Manage Table",
        columns: [...tableColumns],
        data: [...tableData],
      },
    };
  },
};
</script>
<style></style>
