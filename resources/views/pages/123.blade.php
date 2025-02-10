@extends('../layout/side-menu')

@section('subhead')
<title>Dữ liệu đợt</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<link rel="stylesheet" href="https://codepen.io/fancyapps/pen/Kxdwjj" />

@endsection

@section('subcontent')
<link rel="stylesheet" href="/dist/css/select2.css">
<link rel="shortcut icon" href="http://sharecode.vn/Image/sharecode.ico" type="image/x-icon" />
<style>
    .tooltip {
        display: block !important;
        z-index: 10000;
    }

    .tooltip .tooltip-inner {
        background: black;
        color: white;
        border-radius: 16px;
        padding: 5px 10px 4px;
    }

    .tooltip .tooltip-arrow {
        width: 0;
        height: 0;
        border-style: solid;
        position: absolute;
        margin: 5px;
        border-color: black;
    }

    .tooltip[x-placement^="top"] {
        margin-bottom: 5px;
    }

    .tooltip[x-placement^="top"] .tooltip-arrow {
        border-width: 5px 5px 0 5px;
        border-left-color: transparent !important;
        border-right-color: transparent !important;
        border-bottom-color: transparent !important;
        bottom: -5px;
        left: calc(50% - 5px);
        margin-top: 0;
        margin-bottom: 0;
    }

    .tooltip[x-placement^="bottom"] {
        margin-top: 5px;
    }

    .tooltip[x-placement^="bottom"] .tooltip-arrow {
        border-width: 0 5px 5px 5px;
        border-left-color: transparent !important;
        border-right-color: transparent !important;
        border-top-color: transparent !important;
        top: -5px;
        left: calc(50% - 5px);
        margin-top: 0;
        margin-bottom: 0;
    }

    .tooltip[x-placement^="right"] {
        margin-left: 5px;
    }

    .tooltip[x-placement^="right"] .tooltip-arrow {
        border-width: 5px 5px 5px 0;
        border-left-color: transparent !important;
        border-top-color: transparent !important;
        border-bottom-color: transparent !important;
        left: -5px;
        top: calc(50% - 5px);
        margin-left: 0;
        margin-right: 0;
    }

    .tooltip[x-placement^="left"] {
        margin-right: 5px;
    }

    .tooltip[x-placement^="left"] .tooltip-arrow {
        border-width: 5px 0 5px 5px;
        border-top-color: transparent !important;
        border-right-color: transparent !important;
        border-bottom-color: transparent !important;
        right: -5px;
        top: calc(50% - 5px);
        margin-left: 0;
        margin-right: 0;
    }

    .tooltip[aria-hidden='true'] {
        visibility: hidden;
        opacity: 0;
        transition: opacity .15s, visibility .15s;
    }

    .tooltip[aria-hidden='false'] {
        visibility: visible;
        opacity: 1;
        transition: opacity .15s;
    }
</style>
<div class="grid grid-cols-12 gap-6 " id="datanhom123">
  <div class="col-span-12">
    <div class="w-full mt-8">
      <div class=" mt-6">
        <div class=" w-full">
            <button v-on:click="openmodal()" class="btn btn-primary mr-1 mb-2"> Tạo nhóm trường</button>
            <button v-on:click="openmodal2()" class="btn btn-primary mr-1 mb-2"> Tạo trường</button>
        </div>
        
        <div id="superlarge-modal-size-preview" class="modal " tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-xl" style="width: 50%;">
              <div class="modal-content grid grid-cols-12">
                  <div class="p-5 col-span-12 grid grid-cols-12" id="basic-datepicker ">
                      <div class="preview col-span-12 grid grid-cols-12">
                          <div class=" col-span-12 grid grid-cols-12">
                              <a data-dismiss="modal" href="javascript:;"> <i data-feather="x" class="w-8 h-8 text-gray-500"></i> </a>
                              <label for="" class=" col-span-12 inline-block text-2xl text-center text-red-500 leading-tight">
                                  Thêm mới</label>
                                  
                                  <div class="px-8 py-2 w-full col-span-12  ">
                                      <label for="" class="inline-block text-lg mb-2 leading-tight"> Tên nhóm </label><span class="text-red-500 ml-1">(*)</span>
                                      <input v-model="name" type="text" placeholder="Tên nhóm" class="w-full form-control px-3 form-input form-input-bordered">
                                      <div v-if="valiTennhom" class="w-full text-left mt-2">
                                          <span class="font-normal italic text-red-500 ">Bạn chưa nhập mục này!</span>
                                      </div>
                                  </div>
                                  <div class="px-8 py-3 w-full col-span-6  ">
                                      <label for="" class="inline-block text-lg mb-2 leading-tight"> Mã</label><span class="text-red-500 ml-1">(*)</span>
                                      <input v-model="ma" type="text" placeholder="Mã" class="w-full form-control px-3 form-input form-input-bordered">
                                      <div v-if="valiMa" class="w-full text-left mt-2">
                                          <span class="font-normal italic text-red-500 ">Bạn chưa nhập mục này!</span>
                                      </div>
                                      <div v-if="thongbaoMa" class="w-full text-left mt-2">
                                          <span class="font-normal italic  " v-bind:style="{ color: thongbaoma.check,}">@{{thongbaoma.message}}</span>
                                      </div>
                                  </div>
                                  
                                  <div class="w-full px-8 py-3 col-span-6">
                                      <label for="" class="inline-block text-lg mb-2leading-tight">Nhóm đơn vị</label><span class="text-red-500 ml-1">(*)</span>
                                      <select v-model="donvi" class="form-control form-select px-3 w-full">
                                          <option value="1">-- Chọn nhóm --</option>
                                          <option  v-for="qd in quyetdinhgd" :value="qd.id" > @{{qd.name}} </option>
                                      </select>
                                      <div v-if="valiNhomdv" class="w-full text-left mt-2">
                                          <span class="font-normal italic text-red-500 ">Bạn chưa nhập mục này!</span>
                                      </div>
                                  </div>
                                  <div class="w-full px-8 py-3 col-span-12">
                                      <label for="" class="inline-block text-lg mb-2leading-tight">Nhóm trường báo cáo cha</label>
                                      <select v-model="truongbc" class="form-control form-select px-3 w-full">
                                          <option value="0">-- Chọn nhóm --</option>
                                          <option  v-for="bc in nhomtruongbc" :value="bc.id"> @{{bc.name}}</option>
                                      </select>
                                  </div>
                                  <!-- <div class="w-full px-8 py-3 bg-gray-50 box col-span-12">
                                    <div id="basic-select">
                                        <div class="preview">
                                            <div class="mt-3">
                                                <label>Nested</label>
                                                <div class="mt-2">
                                                    <select data-search="true" class="tail-select w-full">
                                                        <optgroup label="American Actors">
                                                            <option value="1">Leonardo DiCaprio</option>
                                                            <option value="2">Johnny Deep</option>
                                                            <option value="3">Robert Downey, Jr</option>
                                                            <option value="4">Samuel L. Jackson</option>
                                                            <option value="5">Morgan Freeman</option>
                                                        </optgroup>
                                                        <optgroup label="American Actresses">
                                                            <option value="1">Scarlett Johansson</option>
                                                            <option value="2">Jessica Alba</option>
                                                            <option value="3">Jennifer Lawrence</option>
                                                            <option value="4">Emma Stone</option>
                                                            <option value="5">Angelina Jolie</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                           
                                  <div class="px-8 py-3 w-full col-span-12  ">
                                      <label for="" class="inline-block text-lg mb-2 leading-tight"> Mô tả</label>
                                      <textarea id="w3review" v-model="mota" placeholder="Nhập mô tả" class="border border-gray-400 w-full text-gray-600 px-2 py-2" name="w3review" rows="4" cols="50">
                                      </textarea>
                                  </div>
                                  
                                  <div class="px-8 py-3 w-full col-span-12  ">
                                      <label for="" name="field" value="0" class="inline-block text-lg mb-2 leading-tight"> Sử dụng</label>
                                      <input v-model="sudung" type="checkbox" name="field" value="1" class="ml-2">
                                  </div>
                          
                                  <div class="col-span-12 float-right ">
                                    <div class="flex">
                                      <div class="px-5 pb-8 text-center mr-4"  style="margin-left: 20.5rem;"   > <button v-on:click="luunhom" class="btn border-blue-700 border w-24 text-blue-700 text-base hover:bg-blue-600 hover:text-white"><i data-feather="hard-drive" class="w-4 h-4 mr-2"></i>Lưu</button> </div>
                                      <div class="px-5 pb-8 text-center"> <button type="button" data-dismiss="modal" class="bg-theme-6 btn w-24 text-white text-base">Hủy</button> </div>
                                    </div>
                                  </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
        <div id="superlarge-modal-size-preview2" class="modal " tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-xl" style="width: 50%;">
              <div class="modal-content grid grid-cols-12">
                  <div class="p-5 col-span-12 grid grid-cols-12" id="basic-datepicker ">
                      <div class="preview col-span-12 grid grid-cols-12">
                          <div class=" col-span-12 grid grid-cols-12">
                              <a data-dismiss="modal" href="javascript:;"> <i data-feather="x" class="w-8 h-8 text-gray-500"></i> </a>
                              <label for="" class=" col-span-12 inline-block mb-4 mt-4 text-2xl text-center text-red-500 leading-tight">
                                  Thêm mới</label>

                              
                                    <div class="px-8 py-2 w-full col-span-12  ">
                                        <label for="" class="inline-block text-lg mb-2 leading-tight"> Tên trường </label><span class="text-red-500 ml-1">(*)</span>
                                        <input v-model="namet" type="text" placeholder="Tên nhóm" class="w-full form-control px-3 form-input form-input-bordered">
                                        <div v-if="valiTentruong" class="w-full text-left mt-2">
                                          <span class="font-normal italic text-red-500 ">Bạn chưa nhập mục này!</span>
                                      </div>
                                      </div>
                                    <div class="px-8 py-2 w-full col-span-6  ">
                                        <label for="" class="inline-block text-lg mb-2 leading-tight"> Mã</label><span class="text-red-500 ml-1">(*)</span>
                                        <input v-model="mat" type="text" placeholder="Mã" class="w-full form-control px-3 form-input form-input-bordered">
                                        <div v-if="valiMatruong" class="w-full text-left mt-2">
                                          <span class="font-normal italic text-red-500 " >Bạn chưa nhập mục này!</span>
                                      </div>  
                                      <div v-if="thongbaoMatruong" class="w-full text-left mt-2">
                                          <span class="font-normal italic  " v-bind:style="{ color: hienthongbaomat.check,}">@{{hienthongbaomat.message}}</span>
                                      </div>
                                    </div>
                                    
                                    
                                    <div class="w-full px-8 py-2 col-span-6">
                                        <label for="" class="inline-block text-lg mb-2 leading-tight">Loại dữ liệu</label><span class="text-red-500 ml-1">(*)</span>
                                        <div class="">
                                          <select v-model="loaidulieu"
                                              class="w-full px-3 py-2 rounded-lg border mt-1 border-gray-300 focus:outline-none"
                                              name="" id="">
                                              <option value="0" disabled selected>Chọn loại dữ liệu</option>
                                              <option value="1">
                                                  Có / Không
                                              </option>
                                              <option value="2">
                                                  Văn bản
                                              </option>
                                              <option value="3">
                                                  Đa lựa chọn
                                              </option>
                                              <option value="4">
                                                  Kiểu số
                                              </option>
                                          </select>
                                      </div>
                                      <div v-if="valiLoaidulieu" class="w-full text-left mt-2">
                                          <span class="font-normal italic text-red-500 ">Bạn chưa nhập mục này!</span>
                                      </div>
                                    </div>
                                    
                                    <div class="px-8 py-3 w-full col-span-12  ">
                                      <label for="" class="inline-block text-lg mb-2 leading-tight"> Mô tả</label>
                                      <textarea v-model="motat" placeholder="Nhập mô tả" class="border border-gray-400 w-full text-gray-600 px-2 py-2" name="w3review" rows="4" cols="50">
                                      </textarea>
                                  </div>
                                    <!-- <div class="px-8 py-2 w-full col-span-12  ">
                                        <label for="" class="inline-block text-lg mb-2 leading-tight"> Bb cấp</label>
                                        <input v-model="bbcap" type="text" placeholder="1" class="w-full form-control px-3 form-input form-input-bordered">
                                    </div> -->
                                    <div class="w-full px-8 py-3 col-span-6">
                                      <label for="" class="inline-block text-lg mb-2leading-tight">Nhóm đơn vị</label>
                                      <select v-model="bbcap" class="form-control form-select px-3 w-full">
                                          <option value="1">-- Chọn nhóm --</option>
                                          <option  v-for="qd in quyetdinhgd" :value="qd.id" > @{{qd.name}} </option>
                                      </select>
                                      
                                  </div>
                                  <div class="px-8 py-3 w-full col-span-6  ">
                                        <label for="" class="inline-block text-lg mb-1 leading-tight"> Linkapi</label>
                                        <input v-model="linkapi" type="text" placeholder="linkapi" class="w-full form-control px-3 form-input form-input-bordered">
                                    </div>
                                    <div class="px-8 py-2 w-full col-span-12  ">
                                        <label for="" class="inline-block text-lg mb-2 leading-tight"> Hiển thị</label>
                                        <input v-model="hienthi" type="text" placeholder="Hiển thị" class="w-full form-control px-3 form-input form-input-bordered">
                                    </div>
                                    <div class="px-8 py-3 w-full col-span-6  ">
                                      <label for="" name="field" value="1" class="inline-block text-lg mb-2 leading-tight"> Kiểm chứng</label>
                                      <input v-model="kiemchung" type="checkbox" name="field" value="1" class="ml-2">
                                  </div>
                                  <div class="px-8 py-3 w-full col-span-6  ">
                                      <label for="" name="field" value="1" class="inline-block text-lg mb-2 leading-tight"> Sử dụng</label>
                                      <input v-model="sudungt" type="checkbox" name="field" value="1" class="ml-2">
                                  </div>

                                    
                                  
                                    
                                    <div class="col-span-12 float-right ">
                                    <div class="flex">
                                      <div class="px-5 pb-8 text-center mr-4"  style="margin-left: 20.5rem;"   > <button v-on:click="luutruong" class="btn border-blue-700 border w-24 text-blue-700 text-base hover:bg-blue-600 hover:text-white"><i data-feather="hard-drive" class="w-4 h-4 mr-2"></i>Lưu</button> </div>
                                      <div class="px-5 pb-8 text-center"> <button type="button" data-dismiss="modal" class="bg-theme-6 btn w-24 text-white text-base">Hủy</button> </div>
                                    </div>
                                  </div>

                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
        
        <div v-for="(nt,index) in nhomtruong" class="mb-4 w-full bg-white px-4 pt-4 pb-1  rounded-lg shadow-base">
            <div class=" grid grid-cols-12 ">
                <span class="text-lg font-bold  col-span-4">@{{index+1}}. @{{nt.name}}</span>
                <a class="flex items-center mr-4 text-theme-6" v-tooltip="{ content: 'Ẩn hiện' }" href="javascript:;" data-toggle="modal" data-target="#delete-confirmation-modal" v-on:click="hienxoa(nt.id)">
                    
                </a>
                <span class=" text-base text-justify col-span-4"></span>
                <span class=" text-base text-center col-span-2" v-bind:style="{ color: nt.check,}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                @{{nt.trangthai1}} </span>
                <span class="flex justify float-right col-span-2 ml-6">
                        <a v-tooltip="{ content: 'Thêm trường váo nhóm' }" class="cursor-pointer mt-1"  v-on:click="hienmodal_chontruong_vaonhomtbc(nt.id, nt.nhomdonvi_id,)"  >
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                        </a>
                        <a class="ml-4 mr-4  flex items-center "  v-tooltip="{ content: 'Sửa nhóm trường' }" v-on:click="suanhom(nt.id) " href="javascript:;" data-toggle="modal" data-target="#superlarge-modal-size-preview">
                            <svg xmlns="http://www.w3.org/2000/svg"  width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit block mx-auto">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                        </a>

                        <a class="flex items-center mr-4 text-theme-6" v-tooltip="{ content: 'Xóa nhóm' }" href="javascript:;" data-toggle="modal" data-target="#delete-confirmation-modal" v-on:click="hienxoa(nt.id)">
                            <svg xmlns="http://www.w3.org/2000/svg"  width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 block mx-auto">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                            </svg>
                        </a>
                      
                        <!-- bắt đầu làm thử -->
                        <a class="flex items-center mr-4 text-theme-6" v-tooltip="{ content: 'Ẩn hiện' }" href="javascript:;" data-toggle="modal" data-target="#delete-confirmation-modal" v-on:click="hienxoa(nt.id)">
                            <svg xmlns="http://www.w3.org/2000/svg"  width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 block mx-auto">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                            </svg>
                        </a>
                </span>
                <div id="chontruong" class="modal " tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl" style="width: 75%;">
                        <div class="modal-content grid grid-cols-12 bg-gray-100">
                            <div class="p-5 col-span-12 grid grid-cols-12" id="basic-datepicker ">
                                <div class="preview col-span-12 grid grid-cols-12">
                                    <div class=" col-span-12 grid grid-cols-12">
                                        <a data-dismiss="modal" href="javascript:;"> <i data-feather="x" class="w-8 h-8 text-gray-500"></i> </a>
                                            <div class="px-8  w-full col-span-12 mb-1 text-base ">
                                            <div class=" col-span-12 grid grid-cols-12">
                                            <div class="col-span-7">
                                            <label for="" class="inline-block text-lg mb-2 leading-tight text-left">Nhóm đơn vị: </label>
                                            <select   @change="hiendv($event)"  v-model="nhomdv_id" class="form-control form-select px-3 w-full border-gray-500 px-4 text-gray-800 hover:border-blue-600" style="width: 300px; height: 35px; ">
                                                <option value="0">-- Chọn nhóm --</option>
                                                <option v-for="dv in quyetdinhgd" :value="dv.id" >  @{{dv.name}}   </option>
                                            </select>
                                            </div>
                                            <div class="text-right mb-2 relative col-span-5">
                                                <input v-model="searchText" @keyup="search($event)" type="text" class="border-gray-500 px-4 text-gray-500 hover:border-blue-600 border rounded-lg" style="width: 300px; height: 35px; " placeholder="Tìm kiếm...">                                        
                                                <svg xmlns="http://www.w3.org/2000/svg"  style="right: 7px; top:5px; " width="24" height="24" viewBox="0 0 24 24" fill="none"  stroke="#006dff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search absolute"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                            </div>
                                        </div>
                                            <!-- <form>
                                                <div v-for="tr in truongs" class="text-justify"  >
                                                <input type="checkbox" v-on:change="doitrangthaichontruong(tr.truong_id)" v-model="tr.truong_tt">
                                                <label > @{{tr.truong_name}}</label><br>
                                                </div>
                                                <hr class="border-t border-gray-400">
                                            
                                                
                                            </form> -->
                                            <table class="table table-report z-10">                                                                <!-- <div v-for="tr in truongs" class="text-justify"  >
                                                    <input type="checkbox"  v-on:change="themnhom(tr.truong_id)" v-model="tr.truong_tt">
                                                    <label > @{{tr.truong_name}}</label>
                                                </div> -->
                                                <thead>
                                                    <tr>
                                                        <th class="text-center w-1/12 "></th>
                                                        <th class="text-center w-1/12 ">STT</th>
                                                        <th class="text-justify w-7/12 ">Tên trường</th>
                                                        <th class="text-center  w-3/12">Trạng thái</th>
                                                        
                                                    </tr>
                                                </thead>       
                                                <tbody>
                                                    <tr class="intro-x" v-for="(tr,index) in truongs" >
                                                        
                                                        <td class="w-max text-center">
                                                        <input type="checkbox"  v-on:change="doitrangthaichontruong(tr.truong_id)" v-model="tr.truong_tt">
                                                    
                                                        </td>
                                                        <td class="w-max text-center">
                                                        @{{index+1}}
                                                        </td>

                                                        <td class="">
                                                        <div class="text-gray-600 text-base whitespace-no-wrap">@{{tr.truong_name}}</div>
                                                        </td>
                                                        <td class="w-max text-center " v-bind:style="{ color: tr.check,}">                   
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                                        @{{tr.truong_tt2}}
                                                        </td>
                                                        
                                                        
                                                    </tr>
                                                    </tbody>
                                                </table>    
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div id="hienxoa" class="modal " tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl" style="width: 30%;">
                        <div class="modal-content grid grid-cols-12">
                            <div class="p-5 col-span-12 grid grid-cols-12" id="basic-datepicker ">
                                <div class="preview col-span-12 grid grid-cols-12">
                                    <div class=" col-span-12 grid grid-cols-12">
                                        
                                        <div class="  col-span-12 text-center">
                                            <svg xmlns="http://www.w3.org/2000/svg"  width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle text-theme-6"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                        </div>
                                        <label for="" class=" col-span-12 inline-block mb-4 mt-4 text-2xl text-center text-red-500 leading-tight">
                                            Bạn có chắc chắn muốn xóa?</label>

                                        <div class="col-span-12 flex text-center">
                                            <div class="pl-14 pb-8 text-center "> <button v-on:click="xoa(nt.id)" data-dismiss="modal"  class="button w-24 bg-theme-6 py-2 rounded font-bold text-white text-base">Xóa</button> </div>
                                            <div class="pl-14 pb-8 text-center"> <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 py-2 rounded font-bold mr-1 text-base">Hủy</button> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                
            </div>
          <div v-if="!nt.truong">
          <nhomtruong v-on:clicked-something="handleClickInParent" 
            v-on:suatruong2 ="suatruong2"
            v-on:xoatruong2 ="xoatruong2"
            v-on:hienmodalchontruong="hienmodalchontruong"
           :index2="index+1" :nhomtruong="nt.id" :bieubc_id="bieubc_id" class="mt-3" ></nhomtruong>

        </div>
          <div v-else>
            <div v-if="(typeof nt.truong) === 'object'" class="intro-y col-span-12 w-full overflow-auto lg:overflow-visible">
            <hientruong v-on:suatruong2="suatruong2" :bieubc_id="bieubc_id" :nhomtruong_id="nt.id"></hientruong>
              <!-- <table class="table table-report z-10">
                <thead>
                  <tr>
                    <th class="text-center w-1/12 ">STT</th>
                    <th class="text-justify w-7/12 ">Tên trường báo cáo</th>
                    <th class="text-center  w-2/12">Trạng thái</th>
                    <th class="text-center  w-2/12">Điều chỉnh</th>
      
                  </tr>
                </thead>
                <tbody>
                  <tr class="intro-x" v-for="(truong,index) in nt.truong">
                    <td class="w-max text-center">
                      @{{index+1}}
                    </td>

                    <td class="">
                      <div class="text-gray-600 text-base whitespace-no-wrap">@{{truong.name}}</div>
                    </td>
                    <td class="w-max text-center " v-bind:style="{ color: truong.check,}">                   
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                      @{{truong.trangthai1}}
                    </td>
                    
                    <td class="table-report__action w-56">
                        <div class="flex justify-center items-center">
                            <a class="mr-10" v-on:click="suatruong(truong.id)" href="javascript:;" data-toggle="modal" data-target="#superlarge-modal-size-preview2">
                                Sửa
                            </a>
                            <a class="flex items-center text-theme-6" v-on:click="openxoatruong(truong.id)" href="javascript:;" data-toggle="modal" data-target="#delete-confirmation-modal" >
                                <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Xóa
                            </a>
                        </div>
                        <div id="openxoatruong" class="modal " tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-xl" style="width: 30%;">
                                <div class="modal-content grid grid-cols-12">
                                    <div class="p-5 col-span-12 grid grid-cols-12" id="basic-datepicker ">
                                        <div class="preview col-span-12 grid grid-cols-12">
                                            <div class=" col-span-12 grid grid-cols-12">
                                                
                                                <div class="  col-span-12 text-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg"  width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle text-theme-6"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                                </div>
                                                <label for="" class=" col-span-12 inline-block mb-4 mt-4 text-2xl text-center text-red-500 leading-tight">
                                                    Bạn có chắc chắn muốn xóa?</label>

                                                <div class="col-span-12 flex text-center">
                                                    <div class="pl-14 pb-8 text-center "> <button v-on:click="xoatruong(truong.id)" data-dismiss="modal"  class="button w-24 bg-theme-6 py-2 rounded font-bold text-white text-base">Xóa</button> </div>
                                                    <div class="pl-14 pb-8 text-center"> <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 py-2 rounded font-bold mr-1 text-base">Hủy</button> </div>
                                                </div>
                                                

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                  </tr>
                </tbody>
              </table> -->
            </div>
          </div>
        </div>
        <div v-if="nhomtruong.length == 0">
          <div class="text-center mt-10 text-3xl">
            Dữ liệu trống
          </div>
        </div>
        <div>
        
      </div>
      </div>
    </div>
  </div>
  <!-- bắt đầu thử -->
  <!-- <div v-for="nt in nhomtruongbc">
      
      <truongcon  :selected-id="nt.id"></truongcon>

  </div> -->
</div>
<!-- <script>
        $(document).ready(function() {
            $("#states").select2();   
        });
    </script> -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js"></script>
<!-- <script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script> -->
<!-- <script>
    $(document).ready(function() {
        $('.fancybox').fancybox({
            toolbar: false,
            smallBtn: true,
            iframe: {
                preload: false
            }
        })
        // Close current fancybox instance
        parent.jQuery.fancybox.getInstance().close();

        // Adjust iframe height according to the contents
        parent.jQuery.fancybox.getInstance().update();
    });
</script> -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <script src="sweetalert2.all.min.js"></script> -->

<script src="https://unpkg.com/vue@latest"></script>
<script src="https://unpkg.com/vue-select@latest"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<!-- <script type="text/javascript" src="js/tail.select.min.js"></script>

<script src="https://unpkg.com/vue-select@3.0.0"></script>
<script src="https://unpkg.com/vue-select@latest"></script>
<link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">
<link rel="stylesheet" href="https://unpkg.com/vue-select@3.0.0/dist/vue-select.css"> -->


<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/v-tooltip@2.0.2"></script>
<script src="https://unpkg.com/vue-toasted"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/v-tooltip@2.0.2"></script>
<script src="https://unpkg.com/vue-toasted"></script> -->
<script src="/js/data-nhomtruong.js"></script>
<script src="/js/truongcon.js"></script>
<script src="/js/hientruong.js"></script>
<script src="/js/select2.js"></script>
<!-- <script src="/js/jquery-1.8.0.min.js"></script> -->
<script>
Vue.component('v-select', VueSelect.VueSelect)
  Vue.use(Toasted)
  var vm = new Vue({
    el: '#datanhom123',
    data: {
        options: [
      'foo',
      'bar',
      'baz'
        ],
        quyetdinhgd: [],
        suanhomid:'',
        datatruong:[],
        check:0,
        thongbaoma: '',
      datadot: [],
      bieubc_id: '',
      dotbc_id: '',
      nhomtruong: [],
      toggle: false,
      checkluusua: '',
      name: "",
      ma: "",
      donvi: "0",
      truongbc: "0",
      mota: "",
      sudung: 0,
      sudungt: 1,
      bbcap: "",
      kiemchung: 1,
      hienthi: "",
      nhomtruongbc:[],
      quyetdinhgd:[],
      loaidulieu: "",
      selected:'',
      namet: "",
      mat: "",
      motat: "",
      linkapi:"",
      searchText: "",
      // Khai báo dữ liệu phục vụ chức năng ...
      truongs: [],
      truongtrong: [],
      nhomtruong_id: "",
      nhomdv_id: "",
      nhomtbc_id: "",
      truongbc_id: "",
      nhom_id: "",
      timkiem:"",
      valiTennhom: false,
      valiNhomdv: false,
      valiMa: false,
      valiTentruong: false,
      valiMatruong: false,
      valiLoaidulieu: false,
      truong_id:"",
      thongbaoMa: false,
      thongbaoMatruong: false,
      hienthongbaomat: '',
      nhomcha:[],
      truongid: '',
      suatruongid: '',
    },

    watch: {
      tennhom: function(tennhom) {
            const self = this;
            if (self.name != '') {
                self.valiTennhom = false;
            } else {
                self.valiTennhom = true;
            }
      },
      ma: function(ma) {
            const self = this;
            if (self.ma != '') {
                self.valiMa = false;
                self.thongbaoMa = false;
                self.checkma();
                self.thongbaoMa = true;
            } else {
                self.valiMa = true;
                self.thongbaoMa = false;
            }
      },
      donvi: function(donvi) {
            const self = this;
            if (self.donvi != '') {
                self.valiNhomdv = false;
            } else {
                self.valiNhomdv = true;
            }
      },
      tentruong: function(tentruong) {
            const self = this;
            if (self.namet != '') {
                self.valiTentruong = false;
            } else {
                self.valiTentruong = true;
            }
      },
      
      mat: function(mat) {
            const self = this;
            if (self.mat != '') {
                self.valiMatruong = false;
                self.thongbaoMatruong = false;
                self.checkmatruong();
                self.thongbaoMatruong = true;
            } else {
                self.valiMatruong = true;
                self.thongbaoMatruong = false;

            }
      },
      loaidulieu: function(loaidulieu) {
            const self = this;
            if (self.loaidulieu != '') {
                self.valiLoaidulieu = false;
            } else {
                self.valiLoaidulieu = true;
            }
      },
    },
    mounted: function() {
      let uri = window.location.search.substring(1);
      let params = new URLSearchParams(uri);
      this.bieubc_id = <?php echo $id ?>;
      this.load();
      const self = this;
      axios.get("/nhomdonvitbc?name=nhomdonvis").then(function(response) {
          // handle success
          self.quyetdinhgd = response.data;
      });
      axios.get("/nhomtruongbctbc?name=nhomtruongbaocaos").then(function(response) {
          // handle success
          self.nhomtruongbc = response.data;
      });
      axios.get("/nhom-truong-bao-cao2")
        .then(function(response) {
            self.nhomcha = response.data;
            
    });

    },
    methods: {
        toggleShow(id) {
            
            // this.toggle = id;
            // this.toggle = !this.toggle;
        },
            
        // toggleShow(id) {
        //     id = !id;
        //     // this.toggle = id;
        //     // this.toggle = !this.toggle;
        // },
        //     // Hàm check mã nhóm trường bc
        checkma(){
            const self = this;
            axios.get("/checkmanhom?ma=" + self.ma)
            .then(function(response) {
                self.thongbaoma = response.data;  
            });
        },
      
        // Hàm check mã trường bc
        checkmatruong(){
            const self = this;
            axios.get("/checkmatruong?mat=" + self.mat)
            .then(function(response) {
                self.hienthongbaomat = response.data;  
            });
        },

      search: function(e) {
          const self = this;
          // Lấy dữ liệu khi nhập vào searchText
          self.searchText = e.target.value;
          // Gọi đến modal để hiện lên kết quả tìm kiếm
          self.hienmodal_chontruong_vaonhomtbc(self.nhomtbc_id, self.nhomdv_id, e.target.value );
          
      },

      // hàm hiện đơn vị trong modal 
      hiendv(e){
        const self = this;
        console.log(e.target.value);
        axios.get("/danh-sach-tbc?nhombc_id=" + self.nhomtbc_id + "&nhomdv_id=" + e.target.value).then(function(response) {
        self.nhomdv_id = response.data['nhomdv_id'];
        self.truongs = response.data['datas'];
          
        });
      },


      thongbaothanhcong() {
          this.$toasted.show("Cập nhật thành công !!", {
              type: 'success',
              duration: 3000,
              theme: 'toasted-primary'
          })
      },
      thongbaothatbai(test) {
          this.$toasted.show(test, {
              type: 'error',
              duration: 3000,
              theme: 'toasted-primary'
          })
      },
      xoathanhcong() {
          this.$toasted.show("Xóa văn bản thành công !!", {
              type: 'success',
              duration: 3000,
              theme: 'toasted-primary'
          })
      },

      // hàm load lại trang nhóm bc
      load() {
        const self = this;
        axios.get("/nhom-truong-bao-cao?bieubc_id=" + <?php echo $id ?>)
          .then(function(response) {
              self.nhomtruong = response.data;
             
        });
      },

      // hàm select nhóm cha
    //   nhomcha() {
    //     const self = this;
    //     axios.get("/nhom-truong-bao-cao2")
    //       .then(function(response) {
    //           self.nhomcha = response.data;
             
    //     });
    //   },
      // mở modal thêm nhóm
      openmodal() {
        const self = this;
        self.name = '';
        self.ma = '';
        self.donvi = '';
        self.truongbc = '';            
        self.mota = '';
        self.sudung = 1;
        self.valiTennhom = false;
        self.valiMa = false;
        self.thongbaoMa = false;
        self.valiNhomdv = false;
        self.checkluusua = 1;
        cash('#superlarge-modal-size-preview').modal('show');

      },
      
      // mở modal thêm trường 
      openmodal2() {
          const self = this;
          self.namet = '';
          self.mat = '';
          self.loaidulieu = '';
          self.bbcap = '';            
          self.motat = '';
          self.sudungt = 1;
          self.kiemchung = 1;
          self.hienthi = '';
          self.linkapi = '';
          self.checkluusua = 1;
          cash('#superlarge-modal-size-preview2').modal('show');

      },

      // hàm hiện danh sách trường 
      // Hiểm thị modals và ô search cho phép tìm và chọn các trường báo cáo vào nhóm trường.
      hienmodal_chontruong_vaonhomtbc(nhomtbc_id, nhomdonvi_id, searchText ) {
          const self = this;
         //console.log(nhomtbc_id);
         this.nhomtbc_id = nhomtbc_id;
          this.nhomdv_id = nhomdonvi_id;
            if(searchText == undefined){
                axios.get("/danh-sach-tbc?nhombc_id=" + nhomtbc_id + "&nhomdv_id=" +  self.nhomdv_id).then(function(response) {
                self.nhomdv_id = response.data['nhomdv_id'];
                self.truongs = response.data['datas'];
            });
            }else{
            axios.get("/danh-sach-tbc?nhombc_id=" + nhomtbc_id + "&nhomdv_id=" +  self.nhomdv_id + "&searchtext=" + searchText).then(function(response) {
            self.nhomdv_id = response.data['nhomdv_id'];
            self.truongs = response.data['datas'];
            });
        }
          cash('#chontruong').modal('show');
          //  self.search();
      },

      // hàm thay đổi nút checkbox
      doitrangthaichontruong(truong_id){
        axios.get("/thaydoicheckbox?nhombc_id=" + this.nhomtbc_id + "&truong_id=" + truong_id).then(function(response) {
        //self.data = response.data;
        self.thongbaothanhcong();
        //self.load();
        });
        
        //self.thongbaothanhcong();
      },

      // hàm lưu thêm nhóm và sửa nhóm biểu bc
      luunhom() {
        const self = this;
        if (self.name == '') {
            self.valiTennhom = true;
        }

        if (self.ma == '') {
            self.valiMa = true;
        }

        if (self.donvi == '') {
            self.valiNhomdv = true;
        }
        if (self.sudung == '' || self.sudung == false || self.sudung == null) {
            self.sudung = 0;
        }
        if (self.sudung ==  true) {
            self.sudung = 1;
        }
        if (self.name == '' || self.ma == '' || self.donvi == '' ) {
            self.thongbaothatbai();        
        }else{ 
            if (self.checkluusua == 1) {
                axios.get("/tao-nhomtruong-baocao?name=" + self.name +"&ma=" + self.ma + "&donvi=" + self.donvi +"&truongbc=" + self.truongbc +
                    "&mota=" + self.mota + "&sudung=" + self.sudung ).then(function(response) {
                    // handle success
                    self.id = '';
                    self.name = '';
                    self.ma = '';
                    self.donvi = '';
                    self.truongbc = '';
                    self.mota = '';
                    self.sudung = '';
                    
                    // self.hamphantrang(self.phantrang.tranghientai, self.searchText),
                    // cash('#superlarge-modal-size-preview').modal('hide');
                    self.thongbaothanhcong()
                    self.load();
                     
                })
                .catch(function(error) {
                    self.thongbaothatbai(error)
                })   
            } 
        // hàm sửa
        else {
            axios.get("/sua-nhomtruong-baocao?name=" + self.name +  "&id=" + self.id +"&ma=" + self.ma + "&donvi=" + self.donvi +"&truongbc=" + self.truongbc +
                  "&mota=" + self.mota + "&sudung=" + self.sudung )
                  .then(function(response) {
                    self.id = '';
                  self.name = '';
                  self.ma = '';
                  self.donvi = '';
                  self.truongbc = '';
                  self.mota = '';
                  self.sudung = '';
                
                  // self.hamphantrang(self.phantrang.tranghientai, self.searchText),
                  // cash('#superlarge-modal-size-preview').modal('hide');
                  self.thongbaothanhcong()
                  self.load();
                })
                .catch(function(error) {
                    self.thongbaothatbai(error)
                });
        }
        }
      },

      // hàm hiển thị nhóm biểu bc khi click vào icon sửa
      suanhom(id) {
        const self = this;
        axios.get("/hienthisuanhombc?id=" + id )
            .then(function(response) {
                self.id = response.data['id'];
                self.name = response.data['name'];
                self.ma = response.data['ma'];
                self.donvi = response.data['nhomdonvi_id'];
                self.truongbc = response.data['nhomtruongbaocao_id'];
                self.mota = response.data['mota'];
                self.sudung = response.data['sudung'];
                self.thongbaoMa = false;
                self.checkluusua = 0;
                
            });
           
      },

      // hiệm modal hỏi chắc chắn xóa nhóm trường bc không
      hienxoa(id){
        const self = this;
        self.nhom_id = id;
        cash('#hienxoa').modal('show');
      },

      // Hàm xóa nhóm biểu bc
      xoa() {     
        const self = this;       
        axios.get("/xoanhombc?nhom_id=" + self.nhom_id)
            .then(function(response) {
                self.xoathanhcong();
                self.load();
                
        });
      },

    // hiệm modal hỏi chắc chắn xóa trường bc không
      openxoatruong(id){
        const self = this;
        self.truong_id = id;
        cash('#openxoatruong').modal('show');
      },

      // hàm xóa trường bc
      xoatruong(){
        const self = this;
          axios.get("/xoatruongbc?truong_id=" + self.truong_id)
              .then(function(response) {
                  self.xoathanhcong();
                  self.load();
          });
      },
      
      // hàm lưu thêm trường và sửa trường
      luutruong() {
        const self = this;
        if (self.namet == '') {
            self.valiTentruong = true;
        }

        if (self.mat == '') {
            self.valiMatruong = true;
        }

        if (self.loaidulieu == '') {
            self.valiLoaidulieu = true;
        }
        if (self.sudungt == '' || self.sudungt == false || self.sudungt == null) {
            self.sudungt = 0;
        }
        if (self.sudungt ==  true) {
            self.sudungt = 1;
        }
        if (self.kiemchung == '' || self.kiemchung == false || self.kiemchung == null) {
            self.kiemchung = 0;
        }
        if (self.kiemchung ==  true) {
            self.kiemchung = 1;
        }
        if (self.namet == '' || self.mat == '' || self.loaidulieu == '') {
            self.thongbaothatbai();        
        }else{ 
        if (self.checkluusua == 1) {
          axios.get("/tao-truong-baocao?namet=" + self.namet + "&mat=" + self.mat + "&loaidulieu=" + self.loaidulieu +
                  "&motat=" + self.motat + "&sudungt=" + self.sudungt + "&bbcap=" + self.bbcap + "&hienthi=" + self.hienthi + "&kiemchung=" + self.kiemchung + "&linkapi=" + self.linkapi 
              ).then(function(response) {
                  // handle success
                  self.id = '';
                  self.namet = '';
                  self.mat = '';
                  self.loaidulieu = '';
                  self.motat = '';
                  self.bbcap = '';
                  self.hienthi = '';
                  self.kiemchung = '';
                  self.sudungt = '';
                  self.linkapi = '';
                  // self.hamphantrang(self.phantrang.tranghientai, self.searchText),
                  // cash('#superlarge-modal-size-preview').modal('hide');
                  self.thongbaothanhcong()
               
              })
              .catch(function(error) {
                  self.thongbaothatbai(error)
              })
        } 
        // hàm sửa
        else {
            axios.get("/sua-truong-baocao?namet=" + self.namet +  "&id=" + self.id + "&mat=" + self.mat + "&loaidulieu=" + self.loaidulieu +
                  "&motat=" + self.motat + "&sudungt=" + self.sudungt + "&bbcap=" + self.bbcap + "&hienthi=" + self.hienthi + "&kiemchung=" + self.kiemchung + "&linkapi=" + self.linkapi  )
                  .then(function(response) {
                    self.id = '';
                  self.namet = '';
                  self.mat = '';
                  self.loaidulieu = '';
                  self.motat = '';
                  self.bbcap = '';
                  self.hienthi = '';
                  self.kiemchung = '';
                  self.sudungt = '';
                  self.linkapi = '';
                
                  // self.hamphantrang(self.phantrang.tranghientai, self.searchText),
                  // cash('#superlarge-modal-size-preview').modal('hide');
                  self.thongbaothanhcong()
                 
                })
                .catch(function(error) {
                    self.thongbaothatbai(error)
                });
        }
        }
      },

      // hàm hiển thị trường bc khi click vào icon
      suatruong(id) {
        const self = this;
        axios.get("/hienthisuatruongbc/" + id )
            .then(function(response) {
                self.id = response.data['id'];
                self.namet = response.data['name'];
                self.mat = response.data['ma'];
                self.loaidulieu = response.data['loaidulieu'];
                self.bbcap = response.data['bbcap'];
                self.motat = response.data['mota'];
                self.hienthi = response.data['hienthi'];
                self.kiemchung = response.data['kiemchung'];
                self.sudungt = response.data['sudung'];
                self.linkapi = response.data['linkapi'];
                self.checkluusua = 0;
                
            });
           
      },
 
      // hàm component con gọi đến 
      handleClickInParent(id) {
        //this.xoanhom(id);
        //this.xoatruong(id);
        // this.suatruong(id);
        // this.suanhom(id);
       // this.hienxoa(id);
        //this.openxoatruong(id);
        // this.suatruong(id);
        // this.suanhom(id);
        //console.log(id);
      },

    //     suanhom2(id) {
    //     //console.log(id);
        
    //     this.suanhom(id); 
        
    // },
    hienmodalchontruong(id){
        this.hienmodal_chontruong_vaonhomtbc(id,1,);
    },

    // modalxoa(id) {
    //     this.truongid = id;
    //     this.hienxoa(id); 
    //     console.log(id);   
    // },
    // xoanhom2(id) {
    //     this.xoanhom(id);    
    // },
    xoatruong2(id) {
        this.xoatruong(id);    
    },
    // chacchanxoa() {
    //     const self = this;       
    //     axios.get("/xoanhombc?nhom_id=" + self.truongid)
    //         .then(function(response) {
    //             self.xoathanhcong();
    //             self.load();
    //     });
    // },
    
    suatruong2(id) {
        this.suatruong(id);    
    },
    }
  })
</script>
<style>
    .testthu {
  max-width: 30em;
  margin: 1em auto;
}
    .danhsach{
        position: absolute;
        display: block;
        padding: 20px 40px;
        text-transform: uppercase;
        text-decoration: none;
        color: #fff;
        font-size: 28px;
        letter-spacing: 2px;
    }
      
</style>
@endsection