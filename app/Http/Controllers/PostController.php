<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Portal;
use Illuminate\Http\Request;
use App\Models\Post;
use Yajra\DataTables\Facades\DataTables;

class PostController extends Controller
{
    public function post(Request $request)
    {
        return view('portal.post');
    }

    public function ajaxPost(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $Post = Post::orderBy('id', 'desc');
        $Post = searchColum($Post, $searchcolum, $searchnow);

        $Post = $Post->get();
        foreach ($Post as $btc) {
            $btc->stt = ++$dem;
        }
        return DataTables::of($Post)->make(true);
    }

    public function savePost(Request $request)
    {
        $Post = new Post();
        $Post->title = $request->title;
        $Post->slug = $request->slug;
        $Post->desc = $request->desc;
        $Post->content = $request->content;

        if ($request->hasFile('file')) {
            $fileName = $request->file('file')->getClientOriginalName();
            $fileNameToStore = time() . '-' . $fileName;

            // Lưu file với tên duy nhất vào thư mục uploads
            $path = $request->file('file')->storeAs('uploads', $fileNameToStore, 'public');
            // Lưu đường dẫn file vào cơ sở dữ liệu
            $Post->thumbnail = '/storage/' . $path;
        }

        // Lưu bài viết mới vào cơ sở dữ liệu
        $Post->save();

        // Lưu lịch sử thay đổi (nếu cần)
        Helper::saveHistory('Thêm tin bài', $Post->title);

        return response()->json(['message' => 'Thêm bài viết thành công']);
    }

    public function updatePost(Request $request)
    {

        $Post = Post::where('id', $request->id)->first();

        $Post->title = $request->data['title'];
        $Post->slug = $request->data['slug'];
        $Post->desc = $request->data['desc'];
        $Post->content = $request->data['content'];

        // Kiểm tra nếu có file mới được tải lên
        if ($request->hasFile('file')) {
            // Kiểm tra nếu bài viết đã có ảnh thumbnail cũ, xóa đi
            if ($Post->thumbnail) {
                $oldFilePath = public_path($Post->thumbnail);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath); // Xóa file cũ
                }
            }

            // Lấy tên file gốc
            $fileName = $request->file('file')->getClientOriginalName();

            // Tạo tên file duy nhất bằng cách kết hợp với timestamp để tránh trùng lặp
            $fileNameToStore = time() . '-' . $fileName;

            // Lưu file với tên duy nhất vào thư mục uploads
            $path = $request->file('file')->storeAs('uploads', $fileNameToStore, 'public');

            // Lưu đường dẫn file vào cơ sở dữ liệu
            $Post->thumbnail = '/storage/' . $path;
        }

        // Lưu bài viết sau khi cập nhật
        $Post->save();

        // Lưu lịch sử thay đổi (nếu cần)
        Helper::saveHistory('Sửa tin bài', $Post->title);

        return response()->json(['message' => 'Cập nhật bài viết thành công']);
    }


    public function deletePost(Request $request)
    {
        $Post = Post::where('id', $request->id)->first();
        Helper::saveHistory('Xoá tin bài', $Post->title);

        Post::destroy($request->id);
       return response('Thành công', 200);
    }

    public function trangTin()
    {
        $infoPortal = Portal::first();
        $listPosts = Post::orderBy('id', 'desc')->take(3)->get();
        if ($infoPortal->type == 1) {
            $view = 'giaodien.giaodien1.index';
        } elseif ($infoPortal->type == 2) {
            $view = 'giaodien.giaodien2.index';
        } else {
            abort(500);
        }
        return view($view, [
            'listPosts' => $listPosts,
            'title' =>    $infoPortal->title,
            'description' =>$infoPortal->content,
        ]);
    }
    public function danhMucTrangTin()
    {
        $infoPortal = Portal::first();
        $listPosts = Post::orderBy('id', 'desc')->paginate(10);
        $listPostsOr = Post::orderBy('id','asc')->take(5)->get();
        if ($infoPortal->type == 1) {
            $view = 'giaodien.giaodien1.blog';
        } elseif ($infoPortal->type == 2) {
            $view = 'giaodien.giaodien2.starter-page';
        } else {
            abort(500);
        }
        return view($view, [
            'listPosts' => $listPosts,
            'listPostsOr' => $listPostsOr,
            'title' =>    $infoPortal->title,
            'description' =>$infoPortal->content,
        ]);
    }
    public function chiTietTrangTin(Request $request)
    {
      
        $infoPortal = Portal::first();
        $indexPost = Post::where('slug',$request->slug)->first();
        $listPosts = Post::where('id','!=',$indexPost->id)->orderBy('id', 'desc')->paginate(10);
        if ($infoPortal->type == 1) {
            $view = 'giaodien.giaodien1.blog-details';
        } elseif ($infoPortal->type == 2) {
            $view = 'giaodien.giaodien2.blog-details';
        } else {
            abort(500);
        }
        return view($view, [
            'indexPost' => $indexPost,
            'listPosts' => $listPosts,
            'title' =>    $infoPortal->title,
            'description' =>$infoPortal->content,
        ]);
    }
    public function giaoDien() {
        return view('giaodien.giaodien1.index');
    }
}
