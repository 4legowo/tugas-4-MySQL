 function validateForm() {
            var nama = document.getElementById('nama_user').value;
            var email = document.getElementById('email_user').value;
            var lapangan = document.getElementById('lapangan').value;
            var tanggal = document.getElementById('tanggal').value;
            var jam_mulai = document.getElementById('jam_mulai').value;
            var jam_selesai = document.getElementById('jam_selesai').value;

            if (nama == "" || email == "" || lapangan == "" || tanggal == "" || jam_mulai == "" || jam_selesai == "") {
                alert("Semua field harus diisi.");
                return false;
            }

            // Validasi format email sederhana
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            if (!emailPattern.test(email)) {
                alert("Format email tidak valid.");
                return false;
            }

            // Validasi jam (jam selesai harus setelah jam mulai)
            if (jam_mulai >= jam_selesai) {
                alert("Jam selesai harus setelah jam mulai.");
                return false;
            }

            return true;
        }