<?php namespace mvc\controllers\backend\config;

class Lang
{
    /**
    * Main languages
    *
    * @return   array
    */
    public function langs()
    {
        return [
            'dashboard' => [
                'header' => [
                    'id' => "Selamat Datang di <i>Backend</i>, Bangun Website/Aplikasi Anda Sendiri",
                    'en' => "Welcome to Backend, Build Your Own Website/Application"
                ],
                'tagline' => [
                    'id' => "Mari memulai dengan",
                    'en' => "Lets get started by",
                ],
                'tagline_button' => [
                    'id' => "membuat sebuah konten baru",
                    'en' => "creating a new content",
                ],
            ],
            'home_builder' => [
                'tagline' => [
                    'id' => "Di sini adalah untuk membangun halaman utama dari website/aplikasi
                            yang Anda buat. Jika Anda yakin dan semua telah siap, publikasikan
                            pekerjaan Anda. Jika Anda sedang dalam proses pengerjaan, atur
                            pekerjaan Anda ke 'Pengerjaan', maka halaman bawaan 'construction view'
                            akan ditampilkan di halaman utama",
                    'en' => "Here is to build your main/home page of your website/application.
                            If you're sure and everything is ok, publish your work. If you're in
                            still developing, set your work to construction, and then the default construction
                            view will be displayed on the main/home page",
                ],
            ],
            'contents_storage' => [
                'header' => [
                    'id' => "Pantau konten-konten apa yang telah Anda buat",
                    'en' => "Take a look what contents you've been made"
                ],
                'tagline' => [
                    'id' => "Konten-konten disimpan sebagai <i>file-system</i>. Martabak tidak
                            mengirim konten-konten ke dalam Database (kecuali pengaturan,
                            meta-meta, dan properti-properti), karena kami bukan sebuah
                            aplikasi berbasis <i>Content Management System</i>. Martabak bergerak untuk
                            aplikasi '<i>Website Manager</i>' dengan maksud kami akan membantu Anda membangun
                            <i>website</i>/aplikasi dengan melakukan 'Coding', atau sesuatu yang
                            'tidak terduga'",
                    'en' => "Contents are stored as file-system. Martabak don't send contents
                            into Database (except the settings, metas and properties), because
                            we aren't a Content Management System application. Martabak run for
                            'Website Manager' application and has mean we help you to develop your
                            own website by doing code, or something 'unexpected'",
                ],
            ],
            'registered_routes' => [
                'header' => [
                    'id' => "Daftarkan sebuah rute, atur mereka untuk aplikasi Anda seperti yang Anda
                            inginkan",
                    'en' => "Register a route, manage them for your application as you want"
                ],
                'tagline' => [
                    'id' => "Membuat sebuah rute mungkin berguna di masa depan. Di sini Anda akan melihat
                            semua dari rute-rute yang terdaftar dari <i>website</i>/aplikasi Anda (beberapa
                            dari rute-rute tersebut telah didefinisikan secara otomatis oleh sistem, dan
                            hanya mengandung satu nilai yang diperbolehkan untuk diedit). Untuk rute-rute
                            opsional, memungkinkan untuk membuat kustomisasi. Tapi, Anda harus berhati-hati
                            dengan rute-rute Anda. Pastikan Anda tidak memiliki rute ganda di dalam <i>website</i>/
                            aplikasi Anda. <a href=#>Pelajari tentang rute dan kenapa kami menambahkan fitur ini...</a>",
                    'en' => "Creating a route maybe usefull at future. Here you will see all of your
                            registered routes from your website/application (some of them has been define
                            automatically by system, and they only contain one value allowed to edit). For optional routes,
                            it's possible to make customizations. But, you must be carefull with your routes.
                            Make sure you have no duplicate route in your website/application, or your system will crash.
                            ",
                ],
            ],
            'layouts_management' => [
                'header' => [
                    'id' => "Layout-layout berguna jika Anda mempunyai banyak <i>section</i> dengan kode yang sama",
                    'en' => "Layouts are usefull if you have lot of sections with same codes"
                ],
                'tagline' => [
                    'id' => "Terkadang dalam pengembangan Anda membuat sebuah website/aplikasi dengan banyak <i>section</i>
                            yang mempunyai kode-kode yang sama. Anda tidak perlu mengulang kode Anda secara manual, Anda
                            bisa menggunakan fitur ini dan tambahkan mereka (layout-layout) kapanpun Anda membutuhkannya.",
                    'en' => "Sometimes in developing you create a website/application with many section that
                            have same codes. You don't have to repeat your code manually by the way, you can
                            use this feature and just insert them (layouts) as when as you need it",
                ],
            ],
            'system_settings' => [
                'tagline' => [
                    'id' => "Ini adalah konfigurasi pengaturan-pengaturan sistem Anda. Beberapa dari pengaturan-pengaturan
                            di bawah ini perlu me<i>refresh</i> browser untuk mendapatkan efek",
                    'en' => "This is your system settings configuration. Some of these settings below need
                            to refresh the browser to get the effect",
                ],
            ],
        ];
    }

    /**
    * Indication languages
    *
    * @param    string   $target
    * @return   array
    */
    public function indications($target = '')
    {
        return [
            'save' => [
                'button' => [
                    'id' => 'Simpan',
                    'en' => 'Save'
                ],
                'process' => [
                    'id' => "{$target} Anda telah berhasil disimpan",
                    'en' => "Your {$target} has been saved succesfully",
                ],
            ],
            'delete' => [
                'button' => [
                    'id' => 'Hapus',
                    'en' => 'Delete'
                ],
                'process' => [
                    'id' => "{$target} Anda telah berhasil dihapus",
                    'en' => "Your {$target} has been deleted succesfully",
                ],
                'question' => [
                    'id' => "Apakah Anda yakin ingin menghapus {$target} ini?",
                    'en' => "Are you sure to delete this {$target}?",
                ],
            ],
            'publish' => [
                'button' => [
                    'id' => 'Publikasikan',
                    'en' => 'Publish'
                ],
                'process' => [
                    'id' => "{$target} Anda telah berhasil dipublikasikan",
                    'en' => "Your {$target} has been published succesfully",
                ],
                'status' => [
                    'id' => "Terpublikasi",
                    'en' => "Published",
                ],
            ],
            'draft' => [
                'button' => [
                    'id' => 'Draft',
                    'en' => 'Draft'
                ],
                'process' => [
                    'id' => "{$target} Anda telah berhasil disimpan sebagai sebuah draft",
                    'en' => "Your {$target} has been saved succesfully as a draft",
                ],
                'status' => [
                    'id' => "Dalam <i>Draft</i>",
                    'en' => "Drafted",
                ],
            ],
            'update' => [
                'button' => [
                    'id' => 'Perbarui',
                    'en' => 'Update'
                ],
                'button_setting' => [
                    'id' => 'Perbarui Pengaturan-Pengaturan',
                    'en' => 'Update Settings'
                ],
                'button_profile_info' => [
                    'id' => 'Perbarui Info Profil',
                    'en' => 'Update Profile Info'
                ],
                'process' => [
                    'id' => "{$target} Anda telah berhasil diperbarui",
                    'en' => "Your {$target} has been updated succesfully",
                ],
            ],
            'construction' => [
                'button' => [
                    'id' => 'Pengerjaan',
                    'en' => 'Construction'
                ],
                'process' => [
                    'id' => "{$target} Anda sekarang sedang dalam pengerjaan",
                    'en' => "Your {$target} is in construction now.",
                ],
                'status' => [
                    'id' => "Dalam Pengerjaan",
                    'en' => "Under Construction",
                ],
            ],
            'register' => [
                'button' => [
                    'id' => 'Daftarkan',
                    'en' => 'Register'
                ],
                'button_route' => [
                    'id' => 'Daftarkan Rute Baru',
                    'en' => 'Register New Route'
                ],
                'process' => [
                    'id' => "{$target} Anda telah berhasil didaftarkan.",
                    'en' => "Your {$target} has been registered succesfully.",
                ],
            ],
            'create' => [
                'button' => [
                    'id' => 'Buat',
                    'en' => 'Create'
                ],
                'button_layout' => [
                    'id' => 'Buat Layout Baru',
                    'en' => 'Create New Layout'
                ],
                'process' => [
                    'id' => "{$target} Anda telah berhasil dibuat.",
                    'en' => "Your {$target} has been created succesfully.",
                ],
            ],
            'edit' => [
                'button' => [
                    'id' => "Perbarui",
                    'en' => "Edit",
                ],
            ],
            'quick_edit' => [
                'button' => [
                    'id' => "Perbarui Cepat",
                    'en' => "Quick Edit",
                ],
            ],
            'status' => [
                'status' => [
                    'id' => "Status",
                    'en' => "Status",
                ],
            ],
            'last_updated' => [
                'status' => [
                    'id' => "Terakhir Diperbarui",
                    'en' => "Last Updated",
                ],
            ],
            'method' => [
                'status' => [
                    'id' => "Metode",
                    'en' => "Method",
                ],
            ],
            'undefined' => [
                'status' => [
                    'id' => "Tidak diketahui",
                    'en' => "Undefined",
                ],
            ],
            'created_at' => [
                'status' => [
                    'id' => "Tanggal Dibuat",
                    'en' => "Created At",
                ],
            ],
            'html_live_preview' => [
                'button' => [
                    'id' => "html_live_preview",
                    'en' => "html_live_preview",
                ],
            ],
            'realtime_preview' => [
                'button' => [
                    'id' => "realtime_preview",
                    'en' => "realtime_preview",
                ],
            ],
            'insert_layout' => [
                'button' => [
                    'id' => "tambahkan_layout",
                    'en' => "insert_layout",
                ],
            ],
            'route_prefix' => [
                'button' => [
                    'id' => "prefix_rute",
                    'en' => "route_prefix",
                ],
            ],
            'out' => [
                'button' => [
                    'id' => "Keluar",
                    'en' => "Out",
                ],
            ],
            'select_all' => [
                'status' => [
                    'id' => "Pilih semua {$target}",
                    'en' => "Select all {$target}",
                ],
            ],
            'title' => [
                'status' => [
                    'id' => "Judul",
                    'en' => "Title",
                ],
                'create_placeholder' => [
                    'id' => "Masukkan judul di sini...",
                    'en' => "Enter content title here...",
                ],
            ],
            'slug' => [
                'status' => [
                    'id' => "Slug",
                    'en' => "Slug",
                ],
                'create_placeholder' => [
                    'id' => "masukkan-slug-di-sini",
                    'en' => "enter-content-slug-here",
                ],
            ],
            'process' => [
                'button' => [
                    'id' => "Proses",
                    'en' => "Process",
                ],
            ],
            'action_selected' => [
                'status' => [
                    'id' => "Aksi dipilih",
                    'en' => "Action selected",
                ],
            ],
            'items_selected' => [
                'plural' => [
                    'id' => "item dipilih",
                    'en' => "items selected",
                ],
                'no_plural' => [
                    'id' => "item dipilih",
                    'en' => "item selected",
                ],
            ],
            'newer' => [
                'status' => [
                    'id' => "Terbaru",
                    'en' => "Newer",
                ],
            ],
            'older' => [
                'status' => [
                    'id' => "Terlama",
                    'en' => "Older",
                ],
            ],
            'search' => [
                'status' => [
                    'id' => "cari",
                    'en' => "Search",
                ],
                'placeholder' => [
                    'id' => "Cari di sini...",
                    'en' => "Search here...",
                ],
            ],
            'yes' => [
                'status' => [
                    'id' => "Ya",
                    'en' => "Yes",
                ],
            ],
            'no' => [
                'status' => [
                    'id' => "Tidak",
                    'en' => "No",
                ],
            ],
            'no_contents_found' => [
                'status' => [
                    'id' => "Tidak ada {$target} ditemukan",
                    'en' => "No {$target} found",
                ],
            ],
            'prefix' => [
                'status' => [
                    'id' => "Prefix",
                    'en' => "Prefix",
                ],
                'placeholder' => [
                    'id' => "Masukkan prefix di sini... Contoh: blog",
                    'en' => "Enter prefix here... Example: blog",
                ],
            ],
            'textarea' => [
                'layout_placeholder' => [
                    'id' => "Tulis atau tempel kode layout Anda di sini...",
                    'en' => "Write or paste your layout's code here...",
                ],
            ],
            'route' => [
                'status' => [
                    'id' => "Rute",
                    'en' => "Route",
                ],
                'placeholder' => [
                    'id' => "Masukkan rute di sini... Contoh: /blog",
                    'en' => "Enter route here... Example: /blog",
                ],
            ],
            'target' => [
                'status' => [
                    'id' => "Tujuan",
                    'en' => "Target",
                ],
            ],
            'none' => [
                'status' => [
                    'id' => "Tidak ada",
                    'en' => "None",
                ],
            ],
            'default' => [
                'status' => [
                    'id' => "Bawaan",
                    'en' => "Default",
                ],
            ],
            'path' => [
                'status' => [
                    'id' => "Path",
                    'en' => "Path",
                ],
                'placeholder' => [
                    'id' => "Masukkan nilai path di sini... Contoh: url atau filepath",
                    'en' => "Enter path value here... Example: url or filepath",
                ],
            ],
            'profile_info' => [
                'status' => [
                    'id' => "Info profil",
                    'en' => "Profile info",
                ],
            ],
            'optional_settings' => [
                'status' => [
                    'id' => "Pengaturan-pengaturan opsional",
                    'en' => "Optional settings",
                ],
            ],
            'password' => [
                'setting_tagline' => [
                    'id' => "Jika Anda ingin mengganti sandi Anda, Anda hanya harus mengisi input-input di bawah ini,
                            lalu perbarui profil Anda (biarkan kosong jika Anda ingin mempertahankan sandi
                            Anda saat ini). Pastikan Anda telah memasukkan sebuah sandi yang sulit untuk menjaga
                            Anda tetap aman.",
                    'en' => "If you want to change your password, you just have to fill the inputs bellow, then
                            update your profile (leave empty if you want to keep your current password).
                            Make sure you have entered a difficult password to help you keep in secure.",
                ],
                'old_placeholder' => [
                    'id' => "Masukkan sandi lama...",
                    'en' => "Enter old password...",
                ],
                'new_placeholder' => [
                    'id' => "Masukkan sandi baru...",
                    'en' => "Enter new password...",
                ],
                'confirm_placeholder' => [
                    'id' => "Konfirmasi sandi baru...",
                    'en' => "Confirm new password...",
                ],
                'status' => [
                    'id' => "Sandi",
                    'en' => "Password",
                ],
            ],
            'fullname' => [
                'setting_placeholder' => [
                    'id' => "Nama lengkap Anda...",
                    'en' => "Your fullname...",
                ],
                'status' => [
                    'id' => "Nama Lengkap",
                    'en' => "Fullname",
                ],
            ],
            'username' => [
                'setting_placeholder' => [
                    'id' => "Username Anda...",
                    'en' => "Your username...",
                ],
                'status' => [
                    'id' => "Username",
                    'en' => "Username",
                ],
            ],
            'email' => [
                'setting_placeholder' => [
                    'id' => "Email Anda...",
                    'en' => "Your email...",
                ],
                'status' => [
                    'id' => "Email",
                    'en' => "Email",
                ],
            ],
            'system_language' => [
                'status' => [
                    'id' => "Bahasa Sistem",
                    'en' => "System Language",
                ],
            ],
            'system' => [
                'status' => [
                    'id' => "Sistem",
                    'en' => "System",
                ],
            ],
            'all_activities' => [
                'status' => [
                    'id' => "Semua Activitas",
                    'en' => "All Activities",
                ],
            ],
            'you_have' => [
                'status' => [
                    'id' => "Anda mempunyai",
                    'en' => "You have",
                ],
            ],
            'recent' => [
                'status' => [
                    'id' => "{$target} terbaru",
                    'en' => "Recent {$target}",
                ],
            ],
            'topics' => [
                'status' => [
                    'id' => "Topik-topik",
                    'en' => "Topics",
                ],
            ],
            'sort_by' => [
                'status' => [
                    'id' => "Sortir berdasarkan",
                    'en' => "Sort by",
                ],
            ],
            'logout' => [
                'status' => [
                    'id' => "Keluar",
                    'en' => "Log out",
                ],
            ],
            'new_content' => [
                'status' => [
                    'id' => "Konten Baru",
                    'en' => "New Content",
                ],
            ],
            'dashboard' => [
                'status' => [
                    'id' => "Beranda",
                    'en' => "Dashboard",
                ],
            ],
            'home_builder' => [
                'status' => [
                    'id' => "Pembangun Halaman Utama",
                    'en' => "Home Builder",
                ],
            ],
            'contents_storage' => [
                'status' => [
                    'id' => "Penyimpanan Konten",
                    'en' => "Contents Storage",
                ],
            ],
            'registered_routes' => [
                'status' => [
                    'id' => "Rute Terdaftar",
                    'en' => "Registered Routes",
                ],
            ],
            'layouts_management' => [
                'status' => [
                    'id' => "Managemen Layout",
                    'en' => "Layouts Management",
                ],
            ],
            'system_settings' => [
                'status' => [
                    'id' => "Pengaturan Sistem",
                    'en' => "System Settings",
                ],
            ],
            'controllers_generator' => [
                'status' => [
                    'id' => "Pembuat Controller",
                    'en' => "Controllers Generator",
                ],
            ],
            'custom_metas' => [
                'status' => [
                    'id' => "Kustom Meta",
                    'en' => "Custom Metas",
                ],
            ],
            'system_informations' => [
                'header' => [
                    'id' => "Anda saat ini sedang menggunakan Martabak dengan " . strtolower($target) .
                            " di bawah ini:",
                    'en' => "You are currently using Martabak with " . strtolower($target) . "
                            bellow:",
                ],
                'status' => [
                    'id' => "{$target} sistem",
                    'en' => "System " . strtolower($target),
                ],
            ],
            'type' => [
                'status' => [
                    'id' => "Tipe",
                    'en' => "Type",
                ],
            ],
            'request' => [
                'status' => [
                    'id' => "Permintaan",
                    'en' => "Request",
                ],
            ],
            'value' => [
                'status' => [
                    'id' => "Nilai",
                    'en' => "Value",
                ],
            ],
            'token' => [
                'status' => [
                    'id' => "Token",
                    'en' => "Token",
                ],
            ],
            'edit_content' => [
                'status' => [
                    'id' => "Perbarui Konten",
                    'en' => "Edit Content",
                ],
            ],
            'version' => [
                'status' => [
                    'id' => "Versi",
                    'en' => "Version",
                ],
            ],
            'codename' => [
                'status' => [
                    'id' => "Nama Code",
                    'en' => "Code Name",
                ],
            ],
            'author' => [
                'status' => [
                    'id' => "Author",
                    'en' => "Author",
                ],
            ],
            'released_at' => [
                'status' => [
                    'id' => "Dirilis Pada",
                    'en' => "Released At",
                ],
            ],
            'license' => [
                'status' => [
                    'id' => "Lisensi",
                    'en' => "License",
                ],
            ],
            'footer' => [
                'tagline' => [
                    'id' => '2016 &copy; Martabak Website Manager <br> oleh Dali Kewara',
                    'en' => '2016 &copy; Martabak Website Manager <br> Trademark by Dali Kewara',
                ],
            ],
        ];
    }

    /**
    * Content languages
    *
    * @return   array
    */
    public function contents()
    {
        return [
            'content' => [
                'no_plural' => [
                    'id' => 'Konten',
                    'en' => 'Content',
                ],
                'plural' => [
                    'id' => 'Konten-konten',
                    'en' => 'Contents',
                ],
            ],
            'page' => [
                'no_plural' => [
                    'id' => 'Halaman',
                    'en' => 'Page',
                ],
                'plural' => [
                    'id' => 'Halaman-halaman',
                    'en' => 'Pages',
                ],
            ],
            'route' => [
                'no_plural' => [
                    'id' => 'Rute',
                    'en' => 'Route',
                ],
                'plural' => [
                    'id' => 'Rute-rute',
                    'en' => 'Routes',
                ],
            ],
            'layout' => [
                'no_plural' => [
                    'id' => 'Layout',
                    'en' => 'Layout',
                ],
                'plural' => [
                    'id' => 'Layout-layout',
                    'en' => 'Layouts',
                ],
            ],
            'setting' => [
                'no_plural' => [
                    'id' => 'Pengaturan',
                    'en' => 'Setting',
                ],
                'plural' => [
                    'id' => 'Pengaturan-pengaturan',
                    'en' => 'Settings',
                ],
            ],
            'information' => [
                'no_plural' => [
                    'id' => 'Informasi',
                    'en' => 'Informations',
                ],
                'plural' => [
                    'id' => 'Informasi-informasi',
                    'en' => 'Informations',
                ],
            ],
        ];
    }

    /**
    * Error languages
    *
    * @param    string   $index
    * @return   array
    */
    public function errors($index = '')
    {
        return [
            'errRequest' => [
                'id' => 'Kesalahan permintaan!',
                'en' => 'Bad request!'
            ],
            'errUndefined' => [
                'id' => "{$index} tidak diketahui!",
                'en' => 'Undefined ' . strtolower($index) . '!'
            ],
            'errNotEmpty' => [
                'id' => "{$index} tidak boleh kosong!",
                'en' => "{$index} must not empty!"
            ],
            'errWrongFormat' => [
                'id' => "Format " . strtolower($index) . " salah!",
                'en' => "Wrong " . strtolower($index) . " format!"
            ],
            'errPassword' => [
                'allInputEmpty' => [
                    'id' => "Anda harus mengisi semua input jika Anda ingin mengganti " . strtolower($index) .
                            ' Anda!',
                    'en' => "You must fill all inputs if you want to change your " . strtolower($index) . '!'
                ],
                'doesNotMatch' => [
                    'id' => "{$index} tidak cocok!",
                    'en' => "Your " . strtolower($index) . " does not match!"
                ],
                'confirmationDoesNotMatch' => [
                    'id' => "{$index} konfirmasi tidak cocok!",
                    'en' => "{$index} confirmation does not match!"
                ],
            ],
        ];
    }
}
