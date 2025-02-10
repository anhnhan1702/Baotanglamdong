<?php

namespace App\Console\Commands;

use App\Models\Hienvat;
use Illuminate\Console\Command;

class Getorder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getorderby';

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
        $hienvat = Hienvat::select('id','so_ky_hieu', 'orderby')->get();
        foreach ($hienvat as $hv) {
            $vitri = strpos($hv->so_ky_hieu, '.', 0);
            $substring = substr($hv->so_ky_hieu, $vitri + 1,strlen($hv->so_ky_hieu));
            $vitri2 = strpos($substring, '/', 0);
            $substring2 = substr($substring, 0,$vitri2);
            $suahienvat = Hienvat::find($hv->id);
            $suahienvat->orderby = $substring2;
            $suahienvat->save();
            $this->info($substring2);
        }
    }
}
