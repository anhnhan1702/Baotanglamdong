<?php
use App\Models\Cauhinhhethong;
function mv_test()
{
  return 'mayviet';
}

// Phục vụ tiêu chí
function mv_phuongphaptinhs()
{
  $datas = [
    [
      't' => 'Tỷ lệ %',
      'v' => 1,
    ],
    [
      't' => 'Hạng mức',
      'v' => 2,
    ],
    [
      't' => 'Phép toán',
      'v' => 3,
    ],
    [
      't' => 'Có không',
      'v' => 4,
    ],
    [
      't' => '% hạng mức',
      'v' => 5,
    ],
    [
      't' => 'Đầy đủ',
      'v' => 6,
    ],
  ];
  return $datas;
}

// Lấy tên theo mã
function mv_layten_pptinh($t)
{
  $v = '';
  if ($t == 1) {
    $v = 'Tỷ lệ %';
  }
  if ($t == 2) {
    $v = 'Hạng mức';
  }
  if ($t == 3) {
    $v = 'Phép toán';
  }
  if ($t == 4) {
    $v = 'Có không';
  }
  if ($t == 5) {
    $v = '% hạng mức';
  }
  if ($t == 6) {
    $v = 'Đầy đủ';
  }
  return $v;
}
if (!function_exists('checkerror')) {
function checkerror(Type $var = null)
{
  $cauhinh = Cauhinhhethong::first();
        if($cauhinh->ngungsudung ="có")
        {
            return view('error/error', [
                'text' => $cauhinh->noidungtb
            ]);
        }
}
}
// Cộng query search 
if (!function_exists('searchColum')) {
  function searchColum($table, $searchcolum, $searchnow)
  {
    // Kiểm tra có biến search được đẩy lên hay ko
    if ($searchnow) {
      // Kiểm tra số lượng cột được phép search có lớn hơn 0 ko
      if (count($searchcolum) > 0) {
        // Cộng query
        $table = $table->where($searchcolum[0], 'like', '%' . $searchnow . '%');
        for ($i = 1; $i < count($searchcolum); $i++) {
          $table = $table->orWhere($searchcolum[$i], 'like', '%' . $searchnow . '%');
        }
      }
    }
    return $table;
  }
}


  // Tính điểm tiêu chí