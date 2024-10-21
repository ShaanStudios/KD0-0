<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ftp_server = $_POST['server'];
    $ftp_username = $_POST['username'];
    $ftp_password = $_POST['password'];

    // FTP bağlantısını oluştur
    $conn_id = ftp_connect($ftp_server) or die("FTP sunucusuna bağlanılamadı.");

    // Giriş yap
    if (@ftp_login($conn_id, $ftp_username, $ftp_password)) {
        echo "<h1>Bağlantı Başarılı</h1>";
        echo "<h2>Sunucudaki Dosyalar:</h2>";
        
        // Dosyaları listele
        $files = ftp_nlist($conn_id, ".");
        if ($files !== false) {
            echo "<ul>";
            foreach ($files as $file) {
                echo "<li>" . htmlspecialchars($file) . "</li>";
            }
            echo "</ul>";
        } else {
            echo "Dosyalar listelenemedi.";
        }
    } else {
        echo "Bağlantı başarısız.";
    }

    // Bağlantıyı kapat
    ftp_close($conn_id);
} else {
    echo "Geçersiz istek.";
}
?>