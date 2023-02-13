<template>
  <div class="row">
    <div class="col-12">
      <card :title="table1.title">
        <!-- <div class="table-responsive">
          <base-table
            :data="table1.data"
            :columns="table1.columns"
            thead-classes="text-primary"
          >
          </base-table>
        </div> -->
        <!-- <card>
          <img :src="table1.columns.gambar" alt="" class="card-img-top" />
          <h4 class="card-title">{{ table1.columns.nama_menu }}</h4>
          <div class="row">
            <h5 class="card-subtitle mb-2 text-muted col-6">
              {{ table1.columns.jenis }}
            </h5>
            <h5 class="card-subtitle mb-2 text-right col-6">
              Rp. {{ table1.columns.harga }},00
            </h5>
          </div>
          <p class="card-text">{{ table1.columns.deskripsi }}</p>
        </card> -->
        <card
          v-for="id in table2.data"
          v-bind:key="id"
          class="col-3"
          :title="table2.data.nama_menu"
          :subTitle="table2.data.jenis"
          :subTitle2="table2.data.harga"
        >
          <img :src="table2.data.gambar" alt="" class="card-img-top mb-3" />
          <div class="card-text">{{ table2.data.deskripsi }}</div>
        </card>
      </card>
    </div>
  </div>
</template>
<script>
// import { BaseTable } from "@/components";
// import { Card } from "@/components/Cards";
const tableData = [
  {
    id: 1,
    gambar:
      "data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22320%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20320%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1664f6b99d2%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A16pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1664f6b99d2%22%3E%3Crect%20width%3D%22320%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22119.0859375%22%20y%3D%2297.35%22%3E320x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E",
    nama_menu: "Ayam Goreng",
    jenis: "Makanan",
    harga: 12000,
    deskripsi: "Ayam digoreng",
  },
  {
    id: 2,
    gambar:
      "data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22320%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20320%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1664f6b99d2%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A16pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1664f6b99d2%22%3E%3Crect%20width%3D%22320%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22119.0859375%22%20y%3D%2297.35%22%3E320x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E",
    nama_menu: "Air Putih",
    jenis: "Minuman",
    harga: 5000,
    deskripsi: "Air",
  },
];

export default {
  components: {
    // BaseTable,
    // Card,
  },
  data() {
    return {
      table1: {
        title: "Manage Menu",
      },
      table2: {
        data: [...tableData],
      },
    };
  },
};
// console.log();
</script>
<style></style>
