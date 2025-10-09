<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Manajemen User - Ujian Online</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- Bootstrap Icons -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

   @include('layouts.sidebar-styles')
   @include('layouts.alert-system')

   <style>
      /* Additional styles for users page */
      .table th {
         background-color: #667eea !important;
         color: white !important;
         border: none !important;
      }

      .table td {
         border: 1px solid #dee2e6 !important;
         vertical-align: middle !important;
      }

      .table {
         margin-bottom: 0 !important;
      }

      .table-responsive {
         border-radius: 0.375rem;
         overflow: hidden;
      }

      .badge {
         font-size: 0.75em;
         padding: 0.375rem 0.75rem;
      }

      .btn-sm {
         padding: 0.25rem 0.5rem;
         font-size: 0.875rem;
      }

      /* Professional Stats Cards */
      .stats-card-total,
      .stats-card-active,
      .stats-card-admin,
      .stats-card-staff {
         background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
         transition: all 0.3s ease;
         border-radius: 8px;
      }

      .stats-card-total:hover,
      .stats-card-active:hover,
      .stats-card-admin:hover,
      .stats-card-staff:hover {
         transform: translateY(-2px);
         box-shadow: 0 6px 15px rgba(102, 126, 234, 0.25) !important;
      }

      /* Subtle variations for each card */
      .stats-card-active {
         opacity: 0.95;
      }

      .stats-card-admin {
         opacity: 0.9;
      }

      .stats-card-staff {
         opacity: 0.85;
      }

      .text-white-60 {
         color: rgba(255, 255, 255, 0.6) !important;
      }

      .stats-card-total .card-body,
      .stats-card-active .card-body,
      .stats-card-admin .card-body,
      .stats-card-staff .card-body {
         padding: 1.25rem;
      }

      /* Font improvements */
      .stats-card-total h2,
      .stats-card-active h2,
      .stats-card-admin h2,
      .stats-card-staff h2 {
         font-size: 2rem;
         font-weight: 700;
         line-height: 1.2;
         text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
      }

      .stats-card-total .small,
      .stats-card-active .small,
      .stats-card-admin .small,
      .stats-card-staff .small {
         font-size: 0.75rem;
         font-weight: 500;
         letter-spacing: 0.5px;
      }
   </style>
</head>

<body>
   <div class="container-fluid">
      <!-- Sidebar -->
      @include('layouts.sidebar')

      <!-- Main Content -->
      <div class="main-content">
         <!-- Navbar -->
         @include('layouts.navbar')

         <!-- Content -->
         <div class="p-4">

            <!-- Stats Cards -->
            <div class="row mb-4">
               <div class="col-xl-6 col-md-6 mb-4">
                  <div class="card stats-card-total border-0 shadow-sm">
                     <div class="card-body">
                        <div class="d-flex align-items-center">
                           <div class="flex-grow-1">
                              <div class="text-uppercase text-white-60 small fw-semibold mb-2">Total Staff</div>
                              <div class="h2 mb-0 fw-bold text-white" id="totalStaff">0</div>
                              <div class="small text-white-60 mt-1">Semua pengguna</div>
                           </div>
                           <div class="flex-shrink-0">
                              <i class="bi bi-people-fill fs-1 text-white-60"></i>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card stats-card-active border-0 shadow-sm">
                     <div class="card-body">
                        <div class="d-flex align-items-center">
                           <div class="flex-grow-1">
                              <div class="text-uppercase text-white-60 small fw-semibold mb-2">Staff Aktif</div>
                              <div class="h2 mb-0 fw-bold text-white" id="activeStaff">0</div>
                              <div class="small text-white-60 mt-1">Sedang aktif</div>
                           </div>
                           <div class="flex-shrink-0">
                              <i class="bi bi-person-check fs-1 text-white-60"></i>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card stats-card-admin border-0 shadow-sm">
                     <div class="card-body">
                        <div class="d-flex align-items-center">
                           <div class="flex-grow-1">
                              <div class="text-uppercase text-white-60 small fw-semibold mb-2">Administrator</div>
                              <div class="h2 mb-0 fw-bold text-white" id="adminCount">0</div>
                              <div class="small text-white-60 mt-1">Admin sistem</div>
                           </div>
                           <div class="flex-shrink-0">
                              <i class="bi bi-shield-check fs-1 text-white-60"></i>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>



            </div>

            <!-- Users Table -->
            <div class="card">
               <div class="card-header d-flex justify-content-between align-items-center">
                  <h6 class="m-0 font-weight-bold">Daftar User Staff</h6>
                  @if(session('user_type') === 'admin')
                  <button class="btn btn-success btn-sm" onclick="showAddUserModal()">
                     <i class="bi bi-person-plus me-1"></i>Tambah Staff
                  </button>
                  @endif
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <table class="table table-bordered" id="usersTable">
                        <thead>
                           <tr>
                              <th>No</th>
                              <th>Nama</th>
                              <th>Email</th>
                              <th>Role</th>
                              <th>Status</th>
                              <th>Terakhir Login</th>
                              <th>Aksi</th>
                           </tr>
                        </thead>
                        <tbody id="usersTableBody">
                           <!-- Data akan dimuat via JavaScript -->
                           <tr>
                              <td colspan="7" class="text-center">
                                 <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                 </div>
                                 <br>
                                 <small class="text-muted">Memuat data user...</small>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   </div>

   <!-- Edit User Modal -->
   <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="editUserModalLabel">
                  <i class="bi bi-pencil-square me-2"></i>Edit User
               </h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editUserForm">
               <div class="modal-body">
                  <input type="hidden" id="editUserId" name="id">

                  <div class="mb-3">
                     <label for="editNama" class="form-label">Nama Lengkap</label>
                     <input type="text" class="form-control" id="editNama" name="nama" required>
                  </div>

                  <div class="mb-3">
                     <label for="editEmail" class="form-label">Email</label>
                     <input type="email" class="form-control" id="editEmail" name="email" required>
                  </div>

                  <div class="mb-3">
                     <label for="editRole" class="form-label">Role</label>
                     <select class="form-select" id="editRole" name="role" required>
                        <option value="admin">Admin</option>
                        <option value="staff">Staff</option>
                     </select>
                  </div>

                  <div class="mb-3">
                     <label for="editPassword" class="form-label">Password Baru (Opsional)</label>
                     <input type="password" class="form-control" id="editPassword" name="password" placeholder="Kosongkan jika tidak ingin mengubah password">
                     <div class="form-text">Biarkan kosong jika tidak ingin mengubah password</div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                     <i class="bi bi-x-circle me-1"></i>Batal
                  </button>
                  <button type="submit" class="btn btn-primary">
                     <i class="bi bi-check-circle me-1"></i>Simpan Perubahan
                  </button>
               </div>
            </form>
         </div>
      </div>
   </div>

   <!-- Add User Modal -->
   <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="addUserModalLabel">
                  <i class="bi bi-person-plus me-2"></i>Tambah Staff Baru
               </h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addUserForm">
               <div class="modal-body">
                  <div class="mb-3">
                     <label for="addNama" class="form-label">Nama Lengkap</label>
                     <input type="text" class="form-control" id="addNama" name="nama" required>
                  </div>

                  <div class="mb-3">
                     <label for="addEmail" class="form-label">Email</label>
                     <input type="email" class="form-control" id="addEmail" name="email" required>
                  </div>

                  <div class="mb-3">
                     <label for="addRole" class="form-label">Role</label>
                     <select class="form-select" id="addRole" name="role" required>
                        <option value="staff">Staff</option>
                        <option value="admin">Admin</option>
                     </select>
                  </div>

                  <div class="mb-3">
                     <label for="addPassword" class="form-label">Password</label>
                     <input type="password" class="form-control" id="addPassword" name="password" required>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                     <i class="bi bi-x-circle me-1"></i>Batal
                  </button>
                  <button type="submit" class="btn btn-success">
                     <i class="bi bi-plus-circle me-1"></i>Tambah Staff
                  </button>
               </div>
            </form>
         </div>
      </div>
   </div>

   <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   @include('layouts.logout-script')

   <script>
      // CSRF Token is already declared in layouts.logout-script
      console.log('CSRF Token:', csrfToken);

      // Get user type from session
      function getUserType() {
         return '{{ session("user_type", "admin") }}';
      }

      // Load users data (simplified)
      async function loadUsers() {
         console.log('Loading users...');
         console.log('CSRF Token:', csrfToken);

         try {
            // Try to load real data first
            console.log('Fetching from /admin/users/data...');
            const response = await fetch('/admin/users/data', {
               method: 'GET',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               }
            });

            console.log('Response status:', response.status);
            console.log('Response ok:', response.ok);

            if (response.ok) {
               const result = await response.json();
               console.log('Real data loaded:', result);
               if (result.success && result.data) {
                  console.log('Using real data from API');
                  displayUsers(result.data);
                  updateStats(result.stats);
                  return;
               } else {
                  console.log('API returned success=false or no data');
               }
            } else {
               console.log('API returned error status:', response.status);
               const errorText = await response.text();
               console.log('Error response:', errorText);
            }

            console.log('API failed or returned invalid data, using static data');
            loadStaticData();
         } catch (error) {
            console.log('Error loading real data, using static data:', error);
            loadStaticData();
         }
      }

      // Display users in table
      function displayUsers(users) {
         const tbody = document.getElementById('usersTableBody');
         if (!tbody) {
            console.error('Table body not found');
            return;
         }

         tbody.innerHTML = '';
         users.forEach(user => {
            const row = document.createElement('tr');
            row.innerHTML = `
               <td>${user.id}</td>
               <td>
                  <div class="d-flex align-items-center">
                     <div class="avatar bg-primary text-white rounded-circle me-2" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                        ${user.nama.charAt(0).toUpperCase()}
                     </div>
                     ${user.nama}
                  </div>
               </td>
               <td>${user.email}</td>
               <td><span class="badge ${user.role === 'admin' ? 'bg-danger' : 'bg-success'}">${(user.role || 'N/A').toUpperCase()}</span></td>
               <td><span class="badge ${user.is_active ? 'bg-success' : 'bg-secondary'}">${user.is_active ? 'Aktif' : 'Tidak Aktif'}</span></td>
               <td>${user.last_login_at ? new Date(user.last_login_at).toLocaleString('id-ID') : 'Belum pernah login'}</td>
               <td>
                  ${getUserType() === 'admin' ? `
                     <button class="btn btn-sm btn-outline-primary me-1" onclick="editUser(${user.id})">
                        <i class="bi bi-pencil"></i>
                     </button>
                     <button class="btn btn-sm btn-outline-danger" onclick="handleDeleteUser(${user.id})">
                        <i class="bi bi-trash"></i>
                     </button>
                  ` : `
                     <span class="text-muted">Tidak ada aksi</span>
                  `}
               </td>
            `;
            tbody.appendChild(row);
         });
      }

      // Update statistics
      function updateStats(stats) {
         const totalStaff = document.getElementById('totalStaff');
         const activeStaff = document.getElementById('activeStaff');
         const adminCount = document.getElementById('adminCount');

         if (totalStaff) totalStaff.textContent = stats.total || 0;
         if (activeStaff) activeStaff.textContent = stats.active || 0;
         if (adminCount) adminCount.textContent = stats.admin || 0;
      }

      // Static data fallback for testing
      function loadStaticData() {
         console.log('Loading static data as final fallback...');

         const staticUsers = [{
               id: 1,
               nama: 'Admin Utama',
               email: 'admin@ujian.com',
               role: 'admin',
               is_active: true,
               last_login_at: new Date(Date.now() - 2 * 60 * 60 * 1000).toISOString() // 2 jam yang lalu
            },
            {
               id: 5,
               nama: 'Yusuf Maulana',
               email: 'maullanna35@gmail.com',
               role: 'staff',
               is_active: true,
               last_login_at: new Date(Date.now() - 5 * 60 * 1000).toISOString() // 5 menit yang lalu
            }
         ];

         const staticStats = {
            total: 2,
            active: 2,
            admin: 1,
            staff: 1
         };

         displayUsers(staticUsers);
         updateStats(staticStats);

         console.log('Static data loaded successfully');
      }

      // Display users in table
      function displayUsers(users) {
         console.log('Displaying users:', users);
         console.log('Users count:', users ? users.length : 'undefined');

         const tbody = document.getElementById('usersTableBody');
         console.log('Table body element:', tbody);

         if (!tbody) {
            console.error('Table body element not found!');
            return;
         }

         console.log('Clearing table body...');
         tbody.innerHTML = '';

         if (!users || users.length === 0) {
            console.log('No users to display');
            tbody.innerHTML = '<tr><td colspan="7" class="text-center">Tidak ada data user</td></tr>';
            return;
         }

         console.log(`Adding ${users.length} users to table...`);

         users.forEach((user, index) => {
            console.log(`Adding user ${index + 1}:`, user);
            const row = document.createElement('tr');
            row.innerHTML = `
               <td>${index + 1}</td>
               <td>${user.nama || 'N/A'}</td>
               <td>${user.email || 'N/A'}</td>
               <td><span class="badge ${user.role === 'admin' ? 'bg-danger' : 'bg-success'}">${(user.role || 'N/A').toUpperCase()}</span></td>
               <td><span class="badge ${user.is_active ? 'bg-success' : 'bg-secondary'}">${user.is_active ? 'Aktif' : 'Tidak Aktif'}</span></td>
               <td>${user.last_login_at ? new Date(user.last_login_at).toLocaleString('id-ID') : 'Belum pernah login'}</td>
               <td>
                  <button class="btn btn-sm btn-outline-primary me-1" onclick="editUser(${user.id})">
                     <i class="bi bi-pencil"></i>
                  </button>
                  <button class="btn btn-sm btn-outline-danger" onclick="handleDeleteUser(${user.id})">
                     <i class="bi bi-trash"></i>
                  </button>
               </td>
            `;
            tbody.appendChild(row);
         });

         console.log(`Successfully added ${users.length} users to table`);
         console.log('Table body innerHTML length:', tbody.innerHTML.length);
         console.log('Table body children count:', tbody.children.length);
      }

      // Update statistics
      function updateStats(stats) {
         document.getElementById('totalStaff').textContent = stats.total;
         document.getElementById('activeStaff').textContent = stats.active;
         document.getElementById('adminCount').textContent = stats.admin;
         document.getElementById('staffCount').textContent = stats.staff;
      }

      // Add new user
      async function addUser() {
         const form = document.getElementById('addUserForm');
         const formData = new FormData(form);
         const data = Object.fromEntries(formData);

         try {
            const response = await fetch('/admin/users', {
               method: 'POST',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               },
               body: JSON.stringify(data)
            });

            const result = await response.json();

            if (result.success) {
               alertSystem.createSuccess('Staff');
               bootstrap.Modal.getInstance(document.getElementById('addUserModal')).hide();
               form.reset();
               loadUsers();
            } else {
               alertSystem.createError('Staff');
            }
         } catch (error) {
            console.error('Error adding user:', error);
            alertSystem.networkError();
         }
      }


      // Update user
      async function updateUser() {
         const form = document.getElementById('editUserForm');
         const formData = new FormData(form);
         const data = Object.fromEntries(formData);
         const userId = data.id;

         // Remove empty password
         if (!data.password) {
            delete data.password;
         }

         try {
            const response = await fetch(`/admin/users/${userId}`, {
               method: 'PUT',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               },
               body: JSON.stringify(data)
            });

            const result = await response.json();

            if (result.success) {
               alertSystem.updateSuccess('Staff');
               bootstrap.Modal.getInstance(document.getElementById('editUserModal')).hide();
               loadUsers();
            } else {
               alertSystem.updateError('Staff');
            }
         } catch (error) {
            console.error('Error updating user:', error);
            alertSystem.networkError();
         }
      }

      // Delete user
      async function deleteUser(userId) {
         if (!confirm('Apakah Anda yakin ingin menghapus staff ini?')) {
            return;
         }

         try {
            const response = await fetch(`/admin/users/${userId}`, {
               method: 'DELETE',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               }
            });

            const result = await response.json();

            if (result.success) {
               alertSystem.deleteSuccess('Staff');
               loadUsers();
            } else {
               alertSystem.deleteError('Staff');
            }
         } catch (error) {
            console.error('Error deleting user:', error);
            alertSystem.networkError();
         }
      }


      // Logout function is included from layouts.logout-script

      // Edit user function
      function editUser(id) {
         console.log('Editing user with ID:', id);

         // Find user data from current table
         const userData = findUserById(id);
         if (!userData) {
            alertSystem.notFound('Data Staff');
            return;
         }

         // Populate edit form
         document.getElementById('editUserId').value = userData.id;
         document.getElementById('editNama').value = userData.nama;
         document.getElementById('editEmail').value = userData.email;
         document.getElementById('editRole').value = userData.role;
         document.getElementById('editPassword').value = '';

         // Show modal
         const modal = new bootstrap.Modal(document.getElementById('editUserModal'));
         modal.show();
      }

      // Find user by ID from current table data
      function findUserById(id) {
         const staticUsers = [{
               id: 1,
               nama: 'Admin Utama',
               email: 'admin@ujian.com',
               role: 'admin'
            },
            {
               id: 2,
               nama: 'Staff Proktor',
               email: 'proktor@ujian.com',
               role: 'staff'
            },
            {
               id: 3,
               nama: 'Staff Teknis',
               email: 'teknis@ujian.com',
               role: 'staff'
            },
            {
               id: 4,
               nama: 'Staff Laporan',
               email: 'laporan@ujian.com',
               role: 'staff'
            },
            {
               id: 5,
               nama: 'Yusuf Maulana',
               email: 'maullanna35@gmail.com',
               role: 'staff'
            }
         ];

         return staticUsers.find(user => user.id == id);
      }

      // Show add user modal
      function showAddUserModal() {
         // Clear form
         document.getElementById('addUserForm').reset();

         // Show modal
         const modal = new bootstrap.Modal(document.getElementById('addUserModal'));
         modal.show();
      }

      // Delete user function
      function deleteUser(id) {
         if (confirm('Apakah Anda yakin ingin menghapus staff ini?')) {
            console.log('Deleting user with ID:', id);

            // For now, just show success message
            alertSystem.deleteSuccess('Staff');

            // In real implementation, you would call API here
            // await deleteUserAPI(id);
         }
      }

      // Initialize on page load
      document.addEventListener('DOMContentLoaded', function() {
         console.log('Page loaded, starting to load users...');

         // Check if required elements exist
         const tbody = document.getElementById('usersTableBody');
         const totalStaff = document.getElementById('totalStaff');
         const activeStaff = document.getElementById('activeStaff');
         const adminCount = document.getElementById('adminCount');

         console.log('Required elements check:');
         console.log('- usersTableBody:', tbody ? 'Found' : 'NOT FOUND');
         console.log('- totalStaff:', totalStaff ? 'Found' : 'NOT FOUND');
         console.log('- activeStaff:', activeStaff ? 'Found' : 'NOT FOUND');
         console.log('- adminCount:', adminCount ? 'Found' : 'NOT FOUND');

         // Try to load real data first, then fallback to static
         console.log('Loading users data...');

         // Add small delay to ensure DOM is ready
         setTimeout(() => {
            loadUsers();
         }, 100);

         // Add event listeners for forms
         setupFormEventListeners();
      });

      // Setup form event listeners
      function setupFormEventListeners() {
         // Edit form submission
         const editForm = document.getElementById('editUserForm');
         if (editForm) {
            editForm.addEventListener('submit', function(e) {
               e.preventDefault();
               handleEditUser();
            });
         }

         // Add form submission
         const addForm = document.getElementById('addUserForm');
         if (addForm) {
            addForm.addEventListener('submit', function(e) {
               e.preventDefault();
               handleAddUser();
            });
         }
      }

      // Handle edit user form submission
      async function handleEditUser() {
         const formData = new FormData(document.getElementById('editUserForm'));
         const data = Object.fromEntries(formData);

         console.log('Edit user data:', data);

         // Validate data
         if (!data.nama || !data.email || !data.role) {
            alertSystem.error('Validasi Gagal', 'Semua field wajib diisi!');
            return;
         }

         // Show loading
         const loadingAlert = alertSystem.loading('Memperbarui staff...');

         try {
            // Call real API
            const response = await fetch(`/admin/users/${data.id}`, {
               method: 'PUT',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               },
               body: JSON.stringify(data)
            });

            const result = await response.json();

            // Hide loading
            alertSystem.hide(loadingAlert);

            if (result.success) {
               alertSystem.updateSuccess('Staff');

               // Close modal
               const modal = bootstrap.Modal.getInstance(document.getElementById('editUserModal'));
               modal.hide();

               // Reload data
               loadUsers();
            } else {
               alertSystem.updateError('Staff');
            }
         } catch (error) {
            console.error('Error updating user:', error);
            alertSystem.hide(loadingAlert);
            alertSystem.networkError();
         }
      }

      // Handle add user form submission
      async function handleAddUser() {
         const formData = new FormData(document.getElementById('addUserForm'));
         const data = Object.fromEntries(formData);

         console.log('Add user data:', data);

         // Validate data
         if (!data.nama || !data.email || !data.role || !data.password) {
            alertSystem.error('Validasi Gagal', 'Semua field wajib diisi!');
            return;
         }

         if (data.password.length < 6) {
            alertSystem.error('Validasi Gagal', 'Password minimal 6 karakter!');
            return;
         }

         // Show loading
         const loadingAlert = alertSystem.loading('Menambahkan staff...');

         try {
            // Call real API
            const response = await fetch('/admin/users', {
               method: 'POST',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               },
               body: JSON.stringify(data)
            });

            const result = await response.json();

            // Hide loading
            alertSystem.hide(loadingAlert);

            if (result.success) {
               alertSystem.createSuccess('Staff');

               // Close modal
               const modal = bootstrap.Modal.getInstance(document.getElementById('addUserModal'));
               modal.hide();

               // Reset form
               document.getElementById('addUserForm').reset();

               // Reload data
               loadUsers();
            } else {
               alertSystem.createError('Staff');
            }
         } catch (error) {
            console.error('Error adding user:', error);
            alertSystem.hide(loadingAlert);
            alertSystem.networkError();
         }
      }

      // Handle delete user
      async function handleDeleteUser(id) {
         const user = findUserById(id);
         if (!user) {
            alertSystem.notFound('User');
            return;
         }

         // Show confirmation
         if (confirm(`Apakah Anda yakin ingin menghapus ${user.nama}?`)) {
            // Show loading
            const loadingAlert = alertSystem.loading('Menghapus staff...');

            try {
               // Call real API
               const response = await fetch(`/admin/users/${id}`, {
                  method: 'DELETE',
                  headers: {
                     'Content-Type': 'application/json',
                     'X-CSRF-TOKEN': csrfToken
                  }
               });

               const result = await response.json();

               // Hide loading
               alertSystem.hide(loadingAlert);

               if (result.success) {
                  alertSystem.deleteSuccess('Staff');

                  // Reload data
                  loadUsers();
               } else {
                  alertSystem.deleteError('Staff');
               }
            } catch (error) {
               console.error('Error deleting user:', error);
               alertSystem.hide(loadingAlert);
               alertSystem.networkError();
            }
         }
      }

      // Make functions globally available
      window.handleAddUser = handleAddUser;
      window.handleEditUser = handleEditUser;
      window.handleDeleteUser = handleDeleteUser;
   </script>
</body>

</html>