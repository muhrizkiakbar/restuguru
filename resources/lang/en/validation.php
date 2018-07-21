<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'The :attribute must be accepted.',
    'active_url'           => 'The :attribute is not a valid URL.',
    'after'                => 'The :attribute must be a date after :date.',
    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => 'The :attribute may only contain letters.',
    'alpha_dash'           => 'The :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'The :attribute may only contain letters and numbers.',
    'array'                => 'The :attribute must be an array.',
    'before'               => 'The :attribute must be a date before :date.',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file'    => 'The :attribute must be between :min and :max kilobytes.',
        'string'  => 'The :attribute must be between :min and :max characters.',
        'array'   => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => 'The :attribute confirmation does not match.',
    'date'                 => 'The :attribute is not a valid date.',
    'date_format'          => 'The :attribute does not match the format :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => 'The :attribute must be a valid email address.',
    'exists'               => 'The selected :attribute is invalid.',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'The :attribute field must have a value.',
    'image'                => 'The :attribute must be an image.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'ipv4'                 => 'The :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'The :attribute must be a valid IPv6 address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file'    => 'The :attribute may not be greater than :max kilobytes.',
        'string'  => 'The :attribute may not be greater than :max characters.',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'mimetypes'            => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'The :attribute must be at least :min.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => 'The :attribute must be at least :min characters.',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'not_regex'            => 'The :attribute format is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'The :attribute format is invalid.',
    'required'             => 'The :attribute field is required.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => 'The :attribute has already been taken.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'The :attribute format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        // 'attribute-name' => [
        //     'rule-name' => 'custom-message',
        // ],
        'username'=>[
            'required' => 'Username harus diisi !',
            'min:3' => 'Username minimal 3 huruf !',
            'unique' => 'Username tidak tersedia !',
        ],
        'password'=>[
            'required' => 'Password harus diisi !',
            'min:8' => 'Password minimal 8 huruf !',
        ],
        'nama' => [
            'required' => 'Nama harus diisi !',
        ],
        'Telepon'=>[
            'required' => 'Telepon harus diisi !',
            'numeric' => 'Telepon harus berupa nomor !',
            'min:10'=> 'Telepon minimal 10 digit !',
        ],
        'gaji'=>[
            'required' => 'Gaji harus diisi !',
            'numeric' => 'Gaji harus berupa angka !',
        ],
        'alamat'=>[
            'required'=> 'Alamat harus diisi!'
        ],
        'nama2' => [
            'required' => 'Nama harus diisi !',
        ],
        'Telepon2'=>[
            'required' => 'Telepon harus diisi !',
            'numeric' => 'Telepon harus berupa nomor !',
            'min:10'=> 'Telepon minimal 10 digit !',
        ],
        'gaji2'=>[
            'required' => 'Gaji harus diisi !',
            'numeric' => 'Gaji harus berupa angka !',
        ],
        'alamat2'=>[
            'required'=> 'Alamat harus diisi!',
        ],
        // kategori
        'tambah_nama_kategori'=>[
            'required'=> 'Nama Kategori harus diisi!',
        ],
        'tambah_keterangan'=>[
            'required'=> 'Keterangan harus diisi!',
        ],
        'edit_nama_kategori'=>[
            'required'=> 'Nama Kategori harus diisi!',
        ],
        'edit_keterangan'=>[
            'required'=> 'Keterangan harus diisi!',
        ],
        // produk
        'tambah_kategori'=>[
            'required'=> 'Kategori Produk harus dipilih!',
        ],
        'tambah_nama_produk'=>[
            'required'=> 'Nama Produk harus diisi!',
        ],
        'tambah_satuan'=>[
            'required'=> 'Satuan harus diisi!',
        ],
        'tambah_harga_beli'=>[
            'required'=> 'Harga Beli harus diisi!',
            'numeric' => 'Harga Beli harus berupa angka !',
        ],
        'tambah_harga_jual'=>[
            'required'=> 'Harga Jual harus diisi!',
            'numeric' => 'Harga Jual harus berupa angka !',
        ],
        'tambah_hitung_luas'=>[
            'required'=> 'Hitung Luas harus diisi!',
            'numeric' => 'Hitung Luas harus memilih Ya/Tidak !',
        ],
        'tambah_keterangan'=>[
            'required'=> 'Keterangan harus diisi!',
        ],
        'edit_kategori'=>[
            'required'=> 'Kategori Produk harus dipilih!',
        ],
        'edit_nama_produk'=>[
            'required'=> 'Nama Produk harus diisi!',
        ],
        'edit_satuan'=>[
            'required'=> 'Satuan harus diisi!',
        ],
        'edit_harga_beli'=>[
            'required'=> 'Harga Beli harus diisi!',
            'numeric' => 'Harga Beli harus berupa angka !',
        ],
        'edit_harga_jual'=>[
            'required'=> 'Harga Jual harus diisi!',
            'numeric' => 'Harga Jual harus berupa angka !',
        ],
        'edit_hitung_luas'=>[
            'required'=> 'Hitung Luas harus diisi!',
            'numeric' => 'Hitung Luas harus memilih Ya/Tidak !',
        ],
        'edit_keterangan'=>[
            'required'=> 'Keterangan harus diisi!',
        ],
        // supplier
        'tambah_nama_supplier'=>[
            'required'=> 'Nama Supplier harus diisi!',
        ],
        'tambah_pemilik_supplier'=>[
            'required'=> 'Pemilik Supplier harus diisi!',
        ],
        'tambah_telpon_supplier'=>[
            'required'=> 'Telepon Supplier harus diisi!',
            'numeric' => 'Telepon Supplier harus berupa angka !',
            'digits_between'=> 'Telepon Supplier minimal 10 digit !',
        ],
        'tambah_email_supplier'=>[
            'required'=> 'Email Supplier harus diisi!',
            'email'=> 'Email Supplier tidak sesuai format email!',
        ],
        'tambah_alamat_supplier'=>[
            'required'=> 'Alamat Supplier harus diisi!',
        ],
        'tambah_rekening_suppliers'=>[
            'required'=> 'Rekening Supplier harus diisi!',
            'numeric' => 'Telepon Supplier harus berupa angka !',
            'digits_between'=> 'Telepon Supplier minimal 12 digit !',
        ],
        'tambah_keterangan_suppliers'=>[
            'required'=> 'Keterangan Supplier harus diisi!',
        ],
        'edit_nama_supplier'=>[
            'required'=> 'Nama Supplier harus diisi!',
        ],
        'edit_pemilik_supplier'=>[
            'required'=> 'Pemilik Supplier harus diisi!',
        ],
        'edit_telpon_supplier'=>[
            'required'=> 'Telepon Supplier harus diisi!',
            'numeric' => 'Telepon Supplier harus berupa angka !',
            'digits_between'=> 'Telepon Supplier minimal 10 digit !',
        ],
        'edit_email_supplier'=>[
            'required'=> 'Email Supplier harus diisi!',
            'email'=> 'Email Supplier tidak sesuai format email!',
        ],
        'edit_alamat_supplier'=>[
            'required'=> 'Alamat Supplier harus diisi!',
        ],
        'edit_rekening_suppliers'=>[
            'required'=> 'Rekening Supplier harus diisi!',
            'numeric' => 'Telepon Supplier harus berupa angka !',
            'digits_between'=> 'Telepon Supplier minimal 12 digit !',
        ],
        'edit_keterangan_suppliers'=>[
            'required'=> 'Keterangan Supplier harus diisi!',
        ],
        'namerole'=>[
            'required'=> 'Nama Role harus diisi !',
            'unique'=> 'Nama Role sudah ada.'
        ],
        'displayrole'=>[
            'required'=> 'Display Role harus diisi !',
        ],
        'descriptionrole'=>[
            'required'=> 'Display Role harus diisi !',
        ],
        'permissionrole'=>[
            'required'=> 'Permission harus diisi !',
        ],
        // special price users
        'pilih_pelanggan'=>[
            'required'=> 'Pelanggan harus dipilih !',
        ],
        'pilih_produk'=>[
            'required'=> 'Produk harus dipilih !',
        ],
        'tambah_harga_khusus'=>[
            'required'=> 'Harga Khusus harus diisi !',
            'numeric' => 'Harga harus berupa angka !',
        ],
        'edit_harga_khusus'=>[
            'required'=> 'Harga Khusus harus diisi !',
            'numeric' => 'Harga harus berupa angka !',
        ],
        // cabang
        'tambah_jenis_cabang'=>[
            'required'=> 'Jenis Cabang harus dipilih !',
        ],
        'tambah_kode_cabang'=>[
            'required'=> 'Kode Cabang harus diisi !',
        ],
        'tambah_nama_cabang'=>[
            'required'=> 'Nama Cabang harus diisi !',
        ],
        'tambah_telepon_cabang'=>[
            'required'=> 'Telepon Cabang harus diisi !',
            'numeric'=> 'Nomor Telepon harus berupa angka !',
        ],
        'tambah_email_cabang'=>[
            'required'=> 'Email Cabang harus diisi !',
            'email'=> 'Email tidak sesuai format email !',
        ],
        'tambah_alamat_cabang'=>[
            'required'=> 'Alamat Cabang harus diisi !',
        ],
        'edit_jenis_cabang'=>[
            'required'=> 'Jenis Cabang harus dipilih !',
        ],
        'edit_kode_cabang'=>[
            'required'=> 'Kode Cabang harus diisi !',
        ],
        'edit_nama_cabang'=>[
            'required'=> 'Nama Cabang harus diisi !',
        ],
        'edit_telepon_cabang'=>[
            'required'=> 'Telepon Cabang harus diisi !',
            'numeric'=> 'Nomor Telepon harus berupa angka',
        ],
        'edit_email_cabang'=>[
            'required'=> 'Email Cabang harus diisi !',
            'email'=> 'Email tidak sesuai format email !',

        ],
        'edit_alamat_cabang'=>[
            'required'=> 'Alamat Cabang harus diisi !',
        ],
        // kategori
        'tambah_nama_kategori'=>[
            'required'=> 'Nama Kategori harus diisi !',
        ],
        'tambah_keterangan'=>[
            'required'=> 'Keterangan harus diisi !',
        ],
        'edit_nama_kategori'=>[
            'required'=> 'Nama Kategori harus diisi !',
        ],
        'edit_keterangan'=>[
            'required'=> 'Keterangan harus diisi !',
        ],
        // jenis pelanggan
        'tambah_jenispelanggan'=>[
            'required'=> 'Jenis Pelanggan harus diisi !',
        ],
        'edit_jenispelanggan'=>[
            'required'=> 'Jenis Pelanggan harus diisi !',
        ],
        // pelanggan
        'tambah_namapemilik'=>[
            'required'=> 'Nama harus diisi !',
        ],
        'tambah_ktppelanggan'=>[
            'required'=> 'KTP harus diisi !',
            'numeric'=> 'KTP harus berupa angka !',
        ],
        'tambah_hppelanggan'=>[
            'required'=> 'Nomor Handphone harus diisi !',
            'numeric'=> 'Nomor Handphone harus berupa angka !',
        ],
        'tambah_namaperusahaan'=>[
            'required'=> 'Nama Perusahaan harus diisi !',
        ],
        'tambah_teleponpelanggan'=>[
            'required'=> 'Telepon harus diisi !',
            'numeric'=> 'Telepon harus berupa angka !',
        ],
        'tambah_emailpelanggan'=>[
            'required'=> 'Email harus diisi !',
            'email'=> 'Email tidak sesuai format email !'
        ],
        'tambah_alamatpelanggan'=>[
            'required'=> 'Alamat harus diisi !',
        ],
        'tambah_jenispelanggan'=>[
            'required'=> 'Jenis Pelanggan harus diisi !',
        ],
        'tambah_limittagihan'=>[
            'required'=> 'Limit Tagihan harus diisi !',
            'numeric'=> 'Limit Tagihan berupa angka !',
        ],
        'tambah_rekpelanggan'=>[
            'required'=> 'No Rekening harus diisi !',
            'numeric'=> 'No Rekening berupa angka !',
        ],
        'tambah_keterangan'=>[
            'required'=> 'Keterangan harus diisi !',
        ],

        'edit_namapemilik'=>[
            'required'=> 'Nama harus diisi !',
        ],
        'edit_ktppelanggan'=>[
            'required'=> 'KTP harus diisi !',
            'numeric'=> 'KTP harus berupa angka !',
        ],
        'edit_hppelanggan'=>[
            'required'=> 'Nomor Handphone harus diisi !',
            'numeric'=> 'Nomor Handphone harus berupa angka !',
        ],
        'edit_namaperusahaan'=>[
            'required'=> 'Nama Perusahaan harus diisi !',
        ],
        'edit_teleponpelanggan'=>[
            'required'=> 'Telepon harus diisi !',
            'numeric'=> 'Telepon harus berupa angka !',
        ],
        'edit_emailpelanggan'=>[
            'required'=> 'Email harus diisi !',
            'email'=> 'Email tidak sesuai format email !'
        ],
        'edit_alamatpelanggan'=>[
            'required'=> 'Alamat harus diisi !',
        ],
        'edit_jenis_pelanggan'=>[
            'required'=> 'Jenis Pelanggan harus diisi !',
        ],
        'edit_limittagihan'=>[
            'required'=> 'Limit Tagihan harus diisi !',
            'numeric'=> 'Limit Tagihan berupa angka !',
        ],
        'edit_rekpelanggan'=>[
            'required'=> 'No Rekening harus diisi !',
            'numeric'=> 'No Rekening berupa angka !',
        ],
        'edit_keterangan'=>[
            'required'=> 'Keterangan harus diisi !',
        ],
        // special price group
        'tambah_jenispelanggan'=>[
            'required'=> 'Jenis Pelanggan harus diisi !',
        ],
        'tambah_produk'=>[
            'required'=> 'Produk harus diisi !',
        ],
        'tambah_harga_khusus'=>[
            'required'=> 'Harga harus diisi !',
            'numeric'=> 'Harga berupa angka !',
        ],
        'id_edit_jenispelanggan'=>[
            'required'=> 'Jenis Pelanggan harus diisi !',
        ],
        'id_edit_produk'=>[
            'required'=> 'Produk harus diisi !',
        ],
        'edit_harga_khusus'=>[
            'required'=> 'Harga harus diisi !',
            'numeric'=> 'Harga berupa angka !',
        ],
        'namemenu'=>[
            'required'=> 'Nama submenu harus diisi !',
            'unique'=> 'Submenu sudah ada !'
        ],
        'icon'=>[
            'required'=> 'Icon harus dipilih !'
        ],
        'page'=>[
            'required'=> 'Halaman harus diisi !'
        ],
        //pengeluaran
        'tambah_jenisPengeluaran'=>[
            'required'=> 'Jenis Pengeluaran harus diisi !',
        ],
        'tambah_sifatAngsuran'=>[
            'required'=> 'Sifat Angsuran harus diisi !',
        ],
        'tambah_mode'=>[
            'required'=> 'Mode harus diisi !',
        ],
        'edit_jenisPengeluaran'=>[
            'required'=> 'Jenis Pengeluaran harus diisi !',
        ],
        'edit_sifatAngsuran'=>[
            'required'=> 'Sifat Angsuran harus diisi !',
        ],
        'edit_mode'=>[
            'required'=> 'Mode harus diisi !',
        ],
        // produk
        'tambah_kategori_bb'=>[
            'required'=> 'Kategori Bahan Baku harus dipilih!',
        ],
        'tambah_nama_bahan'=>[
            'required'=> 'Nama Bahan Baku harus diisi!',
        ],
        'tambah_harga'=>[
            'required'=> 'Harga harus diisi!',
            'numeric' => 'Harga harus berupa angka !',
        ],
        'tambah_batas_stok'=>[
            'required'=> 'Batas Stok harus diisi!',
            'numeric' => 'Batas Stok harus berupa angka !',
        ],
        'edit_kategori_bb'=>[
            'required'=> 'Kategori Bahan Baku harus dipilih!',
        ],
        'edit_nama_bahan'=>[
            'required'=> 'Nama Bahan Baku harus diisi!',
        ],
        'edit_harga'=>[
            'required'=> 'Harga Beli harus diisi!',
            'numeric' => 'Harga Beli harus berupa angka !',
        ],
        'edit_batas_stok'=>[
            'required'=> 'Harga Jual harus diisi!',
            'numeric' => 'Harga Jual harus berupa angka !',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
