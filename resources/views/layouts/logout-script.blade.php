<script>
   // CSRF Token - check if already declared
   if (typeof csrfToken === 'undefined') {
      var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
   }

   // Enhanced logout function
   async function logout() {
      // Use alert system for confirmation
      if (confirm('Apakah Anda yakin ingin logout?')) {
         try {
            // Debug CSRF token
            console.log('CSRF Token:', csrfToken);

            // Show loading state using alert system
            const loadingAlert = alertSystem.loading('Memproses logout...');

            // Try multiple approaches for logout
            let response;

            try {
               // Approach 1: Form data
               const formData = new FormData();
               formData.append('_token', csrfToken || '');

               response = await fetch('/auth/logout', {
                  method: 'POST',
                  headers: {
                     'X-CSRF-TOKEN': csrfToken || ''
                  },
                  body: formData
               });
            } catch (error) {
               console.log('Form data approach failed, trying JSON:', error);

               // Approach 2: JSON
               response = await fetch('/auth/logout', {
                  method: 'POST',
                  headers: {
                     'Content-Type': 'application/json',
                     'X-CSRF-TOKEN': csrfToken || ''
                  },
                  body: JSON.stringify({
                     _token: csrfToken
                  })
               });
            }

            // Hide loading
            alertSystem.hide(loadingAlert);

            console.log('Logout response status:', response.status);
            console.log('Logout response ok:', response.ok);

            if (response.ok) {
               // Show success message using alert system
               alertSystem.success('Logout Berhasil', 'Anda telah berhasil logout. Mengalihkan ke halaman login...');

               // Redirect immediately
               window.location.href = '/';
            } else {
               const errorText = await response.text();
               console.error('Logout failed with status:', response.status, 'Response:', errorText);
               throw new Error(`Logout failed: ${response.status} - ${errorText}`);
            }
         } catch (error) {
            console.error('Logout error:', error);
            alertSystem.error('Logout Gagal', 'Gagal logout. Silakan coba lagi.');
         }
      }
   }

   // Alternative logout function using form submit
   function logoutForm() {
      if (confirm('Apakah Anda yakin ingin logout?')) {
         // Show loading
         const loadingAlert = alertSystem.loading('Memproses logout...');

         // Create form
         const form = document.createElement('form');
         form.method = 'POST';
         form.action = '/auth/logout';

         // Add CSRF token
         const tokenInput = document.createElement('input');
         tokenInput.type = 'hidden';
         tokenInput.name = '_token';
         tokenInput.value = csrfToken || '';
         form.appendChild(tokenInput);

         // Add redirect parameter
         const redirectInput = document.createElement('input');
         redirectInput.type = 'hidden';
         redirectInput.name = 'redirect_to';
         redirectInput.value = '/';
         form.appendChild(redirectInput);

         // Submit form
         document.body.appendChild(form);
         form.submit();
      }
   }

   // Simple logout function with direct redirect
   function simpleLogout() {
      if (confirm('Apakah Anda yakin ingin logout?')) {
         // Show loading
         const loadingAlert = alertSystem.loading('Memproses logout...');

         // Direct redirect to logout endpoint
         window.location.href = '/auth/logout';
      }
   }

   // Show profile function
   function showProfile() {
      alert('Fitur Profil akan segera tersedia!\n\nAnda dapat mengubah informasi profil di sini.');
   }

   // Show settings function
   function showSettings() {
      alert('Fitur Pengaturan akan segera tersedia!\n\nAnda dapat mengatur preferensi aplikasi di sini.');
   }
</script>