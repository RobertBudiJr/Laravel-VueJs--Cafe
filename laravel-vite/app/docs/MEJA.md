## Meja

### Get Meja

Method : GET
Endpoint : `api/kasir/meja`, `api/admin/meja`
Field : None

### Show Meja

Method : GET
Endpoint : `api/kasir/meja/{id}`, `api/admin/meja/{id}`
Field : None

### Create Meja

Method : POST
Endpoint : `api/admin/meja`
Field : Body

```Form Data
nomor_meja:49
status_meja:kosong
```

### Update Meja

Method : PUT
Endpoint : `api/kasir/meja/{id}`, `api/admin/meja/{id}`
Field : Body

```x-www-form-urlencoded
nomor_meja:49
status_meja:kosong
```

### Delete Meja

Method : DELETE
Endpoint : `api/admin/meja/{id}`
Field : None

### Filter Meja

Method : POST
Endpoint : `api/kasir/mejafilter`
Field : Body

```Form Data
status_meja:kosong
```
