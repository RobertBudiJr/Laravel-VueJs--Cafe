## Transaksi

### Get Transaksi

Method : GET
Endpoint : `api/kasir/transaksi`, `api/manajer/transaksi`
Field : None

### Show Transaksi

Method : GET
Endpoint : `api/kasir/transaksi/{id}`, `api/manajer/transaksi/{id}`
Field : None

### Create Transaksi

Method : POST
Endpoint : `api/kasir/transaksi`
Field : Raw JSON

```json
{
    "id_user": "2",
    "id_meja": "2",
    "nama_pelanggan": "Wahyu",
    "status": "belum_bayar",
    "items": [
        {
            "id_menu": "1",
            "jumlah": "2",
            "total_harga": "24000"
        },
        {
            "id_menu": "2",
            "jumlah": "3",
            "total_harga": "9000"
        }
    ]
}
```

### Update Transaksi

Method : PUT
Endpoint : `api/kasir/transaksi/{id}`
Field : Body

```x-www-form-urlencoded
status:lunas
```

### Filter Transaksi

Method : POST
Endpoint : `api/kasir/statusfilter`
Field : Body

```Form Data
status:lunas
```
