<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportFromDataBackupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Import:Data-backup {path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dataBackups = \DB::table('databackups')->orderBy('id', 'asc')->get();

        $username = escapeshellarg(config('database.connections.mysql.username'));
        $password = escapeshellarg(config('database.connections.mysql.password'));
        $host = escapeshellarg(config('database.connections.mysql.host'));
        $database = escapeshellarg(config('database.connections.mysql.database'));
        
        $month = date('m');
        $year = date('Y');
        
        $created_at = $updated_at = now();
        $time = now()->timestamp;
        $filename = "backup-{$time}.sql";
        $backupPath = storage_path("app/backup/{$year}/{$month}");
        $filePath = "{$backupPath}/{$filename}";
        
        // Tạo thư mục nếu chưa tồn tại
        if (!is_dir($backupPath)) {
            if (!mkdir($backupPath, 0755, true) && !is_dir($backupPath)) {
                throw new \RuntimeException("Không thể tạo thư mục backup");
            }
        }
        
        // Thực hiện backup
        $process = new Symfony\Component\Process\Process([
            'mysqldump', "--user={$username}", "--password={$password}", "--host={$host}", $database
        ]);
        $process->setTimeout(300);
        $process->run();
        
        if (!$process->isSuccessful()) {
            throw new \RuntimeException("Backup thất bại: " . $process->getErrorOutput());
        }
        
        // Kiểm tra đường dẫn file nhập
        $path = $this->argument('path');
        if (!is_string($path) || !preg_match('/^[\w\-\/.]+\.sql$/', $path)) {
            throw new \InvalidArgumentException("Đường dẫn không hợp lệ");
        }
        $path = escapeshellarg(storage_path("app/backup/{$path}"));
        
        // Thực hiện import file SQL
        $importProcess = new Symfony\Component\Process\Process([
            'mysql', "--user={$username}", "--password={$password}", "--host={$host}", $database, "<", $path
        ]);
        $importProcess->setTimeout(300);
        $importProcess->run();
        
        if (!$importProcess->isSuccessful()) {
            throw new \RuntimeException("Import thất bại: " . $importProcess->getErrorOutput());
        }
        
        // Cập nhật bảng databackups mà không xóa dữ liệu cũ
        foreach ($dataBackups as $dataBackup) {
            \DB::table('databackups')->insert([
                'name' => $dataBackup->name,
                'size' => $dataBackup->size,
                'timebackup' => $dataBackup->timebackup,
                'created_at' => $dataBackup->created_at,
                'updated_at' => $dataBackup->created_at,
            ]);
        }
        
        // Thêm bản ghi mới
        \DB::table('databackups')->insert([
            'name' => $filename,
            'size' => filesize($filePath),
            'timebackup' => $time,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ]);
        
    }
}
