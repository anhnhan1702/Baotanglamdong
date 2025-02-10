<?php

namespace App\Console\Commands;

use App\Models\Databackup;
use App\Models\Fileuploads;
use App\Models\Hienvat;
use Illuminate\Console\Command;
use Carbon\Carbon;
use File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:run';

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
    
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
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

        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $host = config('database.connections.mysql.host');
        $database = config('database.connections.mysql.database');

        $command = "mysqldump --user={$username} --password={$password} --host={$host} {$database} > {$filePath}";

        $returnVar = null;
        $output = null;

        exec($command, $output, $returnVar);

        if ($returnVar === 0) {
            \DB::table('databackups')->insert([
                'name' => $filename,
                'size' => filesize($filePath),
                'timebackup'  => $time,
                'created_at' => $created_at,
                'created_at' => $updated_at,
            ]);
        } else {
            $this->error("Backup failed with error code: {$returnVar}");
        }
    }
}
