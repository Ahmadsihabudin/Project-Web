<!-- Alert System Component -->
<div id="alertContainer" class="position-fixed" style="top: 20px; right: 20px; z-index: 9999;">
   <!-- Alerts will be dynamically inserted here -->
</div>

<style>
   .alert-custom {
      min-width: 350px;
      max-width: 500px;
      border: none;
      border-radius: 12px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
      backdrop-filter: blur(10px);
      animation: slideInRight 0.4s ease-out;
      margin-bottom: 10px;
   }

   .alert-custom.alert-success {
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      color: white;
      border-left: 4px solid #047857;
   }

   .alert-custom.alert-danger {
      background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
      color: white;
      border-left: 4px solid #b91c1c;
   }

   .alert-custom.alert-warning {
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
      color: white;
      border-left: 4px solid #b45309;
   }

   .alert-custom.alert-info {
      background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
      color: white;
      border-left: 4px solid #1d4ed8;
   }

   .alert-custom .alert-icon {
      width: 24px;
      height: 24px;
      margin-right: 12px;
      flex-shrink: 0;
   }

   .alert-custom .alert-content {
      flex: 1;
   }

   .alert-custom .alert-title {
      font-weight: 600;
      font-size: 14px;
      margin-bottom: 4px;
   }

   .alert-custom .alert-message {
      font-size: 13px;
      opacity: 0.9;
      line-height: 1.4;
   }

   .alert-custom .alert-close {
      background: none;
      border: none;
      color: white;
      font-size: 18px;
      cursor: pointer;
      padding: 0;
      margin-left: 12px;
      opacity: 0.7;
      transition: opacity 0.2s ease;
   }

   .alert-custom .alert-close:hover {
      opacity: 1;
   }

   @keyframes slideInRight {
      from {
         transform: translateX(100%);
         opacity: 0;
      }

      to {
         transform: translateX(0);
         opacity: 1;
      }
   }

   @keyframes slideOutRight {
      from {
         transform: translateX(0);
         opacity: 1;
      }

      to {
         transform: translateX(100%);
         opacity: 0;
      }
   }

   .alert-custom.alert-hide {
      animation: slideOutRight 0.3s ease-in forwards;
   }
</style>

<script>
   // Alert System JavaScript
   class AlertSystem {
      constructor() {
         this.container = document.getElementById('alertContainer');
         this.alerts = [];
      }

      show(type, title, message, duration = 5000) {
         const alertId = 'alert-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9);

         const icons = {
            success: '<i class="bi bi-check-circle-fill"></i>',
            danger: '<i class="bi bi-exclamation-triangle-fill"></i>',
            warning: '<i class="bi bi-exclamation-circle-fill"></i>',
            info: '<i class="bi bi-info-circle-fill"></i>'
         };

         const alertHTML = `
            <div id="${alertId}" class="alert alert-custom alert-${type}" role="alert">
               <div class="d-flex align-items-start">
                  <div class="alert-icon">
                     ${icons[type] || icons.info}
                  </div>
                  <div class="alert-content">
                     <div class="alert-title">${title}</div>
                     <div class="alert-message">${message}</div>
                  </div>
                  <button type="button" class="alert-close" onclick="alertSystem.hide('${alertId}')">
                     <i class="bi bi-x"></i>
                  </button>
               </div>
            </div>
         `;

         this.container.insertAdjacentHTML('beforeend', alertHTML);

         const alertElement = document.getElementById(alertId);
         this.alerts.push(alertId);

         // Auto hide after duration
         if (duration > 0) {
            setTimeout(() => {
               this.hide(alertId);
            }, duration);
         }

         return alertId;
      }

      hide(alertId) {
         const alertElement = document.getElementById(alertId);
         if (alertElement) {
            alertElement.classList.add('alert-hide');
            setTimeout(() => {
               if (alertElement.parentNode) {
                  alertElement.parentNode.removeChild(alertElement);
               }
               this.alerts = this.alerts.filter(id => id !== alertId);
            }, 300);
         }
      }

      hideAll() {
         this.alerts.forEach(alertId => {
            this.hide(alertId);
         });
      }

      // Convenience methods
      success(title, message, duration = 5000) {
         return this.show('success', title, message, duration);
      }

      error(title, message, duration = 7000) {
         return this.show('danger', title, message, duration);
      }

      warning(title, message, duration = 6000) {
         return this.show('warning', title, message, duration);
      }

      info(title, message, duration = 5000) {
         return this.show('info', title, message, duration);
      }

      // CRUD specific methods
      createSuccess(itemName = 'Data') {
         return this.success('Berhasil!', `${itemName} berhasil ditambahkan.`);
      }

      createError(itemName = 'Data') {
         return this.error('Gagal!', `Gagal menambahkan ${itemName}. Silakan coba lagi.`);
      }

      updateSuccess(itemName = 'Data') {
         return this.success('Berhasil!', `${itemName} berhasil diperbarui.`);
      }

      updateError(itemName = 'Data') {
         return this.error('Gagal!', `Gagal memperbarui ${itemName}. Silakan coba lagi.`);
      }

      deleteSuccess(itemName = 'Data') {
         return this.success('Berhasil!', `${itemName} berhasil dihapus.`);
      }

      deleteError(itemName = 'Data') {
         return this.error('Gagal!', `Gagal menghapus ${itemName}. Silakan coba lagi.`);
      }

      deleteConfirm(itemName = 'Data') {
         return this.warning('Konfirmasi', `Apakah Anda yakin ingin menghapus ${itemName}?`);
      }

      loading(message = 'Memproses...') {
         return this.info('Loading', message, 0); // No auto-hide
      }

      validationError(errors) {
         let errorMessage = 'Terjadi kesalahan validasi:';
         if (typeof errors === 'object') {
            errorMessage += '<ul class="mb-0 mt-2">';
            Object.keys(errors).forEach(field => {
               errorMessage += `<li>${errors[field].join(', ')}</li>`;
            });
            errorMessage += '</ul>';
         } else {
            errorMessage = errors;
         }
         return this.error('Validasi Gagal', errorMessage);
      }

      networkError() {
         return this.error('Koneksi Error', 'Tidak dapat terhubung ke server. Periksa koneksi internet Anda.');
      }

      unauthorized() {
         return this.error('Akses Ditolak', 'Anda tidak memiliki izin untuk melakukan aksi ini.');
      }

      notFound(itemName = 'Data') {
         return this.error('Tidak Ditemukan', `${itemName} tidak ditemukan.`);
      }
   }

   // Initialize global alert system
   const alertSystem = new AlertSystem();

   // Make it globally available
   window.alertSystem = alertSystem;
</script>