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
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $host = config('database.connections.mysql.host');
        $database = config('database.connections.mysql.database');

        $month = date('m');
        $year = date('Y');

        $created_at = $updated_at = date('Y-m-d H:i:s');
        $time = now()->timestamp;
        $filename = "backup-" . $time . ".sql";
        $backupPath = storage_path('app/backup').'/'.$year.'/'.$month.'/';
        $filePath = "{$backupPath}/{$filename}";
        
        // Tạo thư mục nếu chưa tồn tại
        if (!file_exists($backupPath)) {
            mkdir($backupPath, 0755, true);
        }
        $backupCommand = "mysqldump --user={$username} --password={$password} --host={$host} {$database} > {$filePath}";
        $backupReturnVar = null;
        $backupOutput = null;
        exec($backupCommand, $backupOutput, $backupReturnVar);

        if ($backupReturnVar !== 0) {
            return; 
        }

        $path = $this->argument('path');
        // Import file SQL
        $command = "mysql --user={$username} --password={$password} --host={$host} {$database} < {$path}";

        $returnVar = null;
        $output = null;

        exec($command, $output, $returnVar);
        \DB::table('databackups')->truncate();
        foreach($dataBackups as $dataBackup){
            \DB::table('databackups')->insert([
                'name' => $dataBackup->name,
                'size' => $dataBackup->size,
                'timebackup'  => $dataBackup->timebackup,
                'created_at' => $dataBackup->created_at,
                'created_at' => $dataBackup->created_at,
            ]);
        }
        $id = \DB::table('databackups')->insertGetId([
            'name' => $filename,
            'size' => filesize($filePath),
            'timebackup'  => $time,
            'created_at' => $created_at,
            'created_at' => $updated_at,
        ]);
    }
}
