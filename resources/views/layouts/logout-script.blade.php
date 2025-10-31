<script>
   // CSRF Token - check if already declared
   if (typeof csrfToken === 'undefined') {
      var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
   }

   // Enhanced logout function
  async function logout() {
     const confirmed = await Swal.fire({
        title: 'Keluar dari Aplikasi?',
        text: 'Anda akan logout dari sesi ini.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, logout',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        reverseButtons: true
     }).then(r => r.isConfirmed);
     if (!confirmed) return;
     const loading = Swal.fire({ title: 'Memproses...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
     try {
        const formData = new FormData();
        formData.append('_token', csrfToken || '');
        const response = await fetch('/auth/logout', { method: 'POST', headers: { 'X-CSRF-TOKEN': csrfToken || '' }, body: formData });
        Swal.close();
        if (response.ok) {
           await Swal.fire({ title: 'Logout Berhasil', icon: 'success', confirmButtonText: 'OK', confirmButtonColor: '#0d6efd' });
           window.location.href = '/';
        } else {
           Swal.fire({ title: 'Logout Gagal', text: 'Silakan coba lagi.', icon: 'error', confirmButtonText: 'Tutup' });
        }
     } catch (_) {
        Swal.close();
        Swal.fire({ title: 'Logout Gagal', text: 'Terjadi kesalahan jaringan.', icon: 'error', confirmButtonText: 'Tutup' });
     }
  }

   // Alternative logout function using form submit
  async function logoutForm() {
     const confirmed = await Swal.fire({
        title: 'Keluar dari Aplikasi?',
        text: 'Anda akan logout dari sesi ini.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, logout',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        reverseButtons: true
     }).then(r => r.isConfirmed);
     if (!confirmed) return;
     const form = document.createElement('form');
     form.method = 'POST';
     form.action = '/auth/logout';
     const tokenInput = document.createElement('input');
     tokenInput.type = 'hidden';
     tokenInput.name = '_token';
     tokenInput.value = csrfToken || '';
     form.appendChild(tokenInput);
     document.body.appendChild(form);
     form.submit();
  }

   // Simple logout function with direct redirect
  async function simpleLogout() {
     const confirmed = await Swal.fire({
        title: 'Keluar dari Aplikasi?',
        text: 'Anda akan logout dari sesi ini.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, logout',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        reverseButtons: true
     }).then(r => r.isConfirmed);
     if (!confirmed) return;
     window.location.href = '/auth/logout';
  }

   // Show profile function
  function showProfile() { Swal.fire({ title: 'Segera Hadir', text: 'Fitur Profil akan segera tersedia.', icon: 'info', confirmButtonText: 'OK' }); }

   // Show settings function
  function showSettings() { Swal.fire({ title: 'Segera Hadir', text: 'Fitur Pengaturan akan segera tersedia.', icon: 'info', confirmButtonText: 'OK' }); }
</script>