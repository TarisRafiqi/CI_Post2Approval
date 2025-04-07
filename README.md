# CI_Post2Approval

Deskripsi
Aplikasi ini merupakan sistem manajemen dan persetujuan postingan yang dibangun menggunakan CodeIgniter 4. Setiap postingan yang dibuat oleh pengguna akan melalui dua tahap persetujuan sebelum dinyatakan disetujui. Proyek ini mengimplementasikan autentikasi pengguna, manajemen role-based access control, serta validasi dan penanganan error. Terdapat tiga role dalam aplikasi ini: Admin, Approver, dan Writer, masing-masing memiliki akses dan tanggung jawab berbeda terhadap alur persetujuan konten.

Fitur-fitur

1. Authentication & Authorization

- User Registration & Login
- Role-Based Access Control (RBAC)
- Session-based login management

2. User Management

- Update profil (nama, username, email)

3. Post Management & Approval Workflow

- CRUD Postingan
- Status postingan: Draft, Waiting Approval, Need Revision, Rejected, Approved
- Dua tahap approval oleh Approver dan Admin

4. Notifikasi

- Flash Message untuk Error & Success
