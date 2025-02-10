@extends('../layout/layout')


@section('subhead')
<title>Làm nét hình ảnh</title>
<style>
    .canvas-item {
        width: 100%;
        flex: 1;
    }
    canvas {
        max-width: 100%;
        max-height: 300px; /* Đặt chiều cao tối đa */
        object-fit: contain;
    }
    @media (min-width: 768px) { 
        .canvas-container {
            margin: 0 -10px;
            display: flex;
            flex-wrap: wrap;
        }
        .canvas-item{
            width: calc(100%/3 - 20px);
            flex: 0 0 calc(100%/3 - 20px);
            margin: 0 10px
        }
    }
</style>
@endsection
@section('subcontent')
    <div id="demo" class="py-6 h-full">
        <div class="mx-auto max-w-8xl flex mb-5 border shadow-md p-2 rounded-md">
            <h1 class="text-base sm:text-2xl font-semibold text-gray-900 dark:text-light uppercase ">Xử lý hình ảnh</h1>
        </div>
        <div class="mb-5">
            <label class="block w-full py-2 font-medium text-[#495057]">Ảnh cần xử lý</label>
            <label for="upload-image" class="bg-white flex-wrap border-2 border-gray-300 border-dashed rounded-md flex justify-center items-center w-full h-40 cursor-pointer">
                <svg stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true" class="h-16 w-16 text-gray-400">
                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg> 
                <p class="text-center block w-full">Click vào đây để thêm ảnh</p>
            </label>
            <input type="file" class="hidden" id="upload-image" accept="image/*"/>
        </div>
        <div class="canvas-container">
            <div class="curent-image canvas-item border p-4 rounded-md  hidden flex-col items-center">
                <canvas class="mb-3 block" id="original-canvas"></canvas>
                <p class="text-center w-full pt-2 border-t">Ảnh gốc</p>
            </div>
            <div class="new-image canvas-item border p-4 rounded-md hidden flex-col items-center relative">
                <button id="download-btn" class="p-3 bg-blue-600  rounded-full absolute right-1 top-1" style="z-index: 999;">
                    <svg style="fill:white;" class="w-3 h-3 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 242.7-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7 288 32zM64 352c-35.3 0-64 28.7-64 64l0 32c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-32c0-35.3-28.7-64-64-64l-101.5 0-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352 64 352zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg>
                </button>
                <canvas class=" block" id="edited-canvas"></canvas>
                <p class="text-center w-full mt-3 pt-2 border-t">Ảnh chỉnh sửa</p>
            </div>
            <div class="canvas-item hidden flex-wrap h-fit items-center" style="height: fit-content;">
                <div class="slider-container mt-4 w-full h-fit">
                    <label for="sharpness-slider">Điều chỉnh làm rõ/làm mờ:</label>
                    <input type="range" id="sharpness-slider" min="-5" max="5" step="0.01" value="1" />
                    <span id="sharpness-value">1</span>
                </div>
                <div class="slider-container mt-4 w-full h-fit">
                    <label for="brightness-slider">Điều chỉnh phơi sáng/làm tối:</label>
                    <input type="range" id="brightness-slider" min="-1" max="1" step="0.01" value="0" />
                    <span id="brightness-value">0</span>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.0/fabric.min.js"></script>
    <script>
        const originalCanvas = new fabric.StaticCanvas('original-canvas');
        const editedCanvas = new fabric.Canvas('edited-canvas');
        const fileInput = document.getElementById('upload-image');
        const sharpnessSlider = document.getElementById('sharpness-slider');
        const sharpnessValueDisplay = document.getElementById('sharpness-value');
        const brightnessSlider = document.getElementById('brightness-slider');
        const brightnessValueDisplay = document.getElementById('brightness-value');
        const downloadBtn = document.getElementById('download-btn');
        
        let originalImage, editedImage;

        // Tỷ lệ tối đa cho canvas
        const MAX_CANVAS_WIDTH = 400; // Chiều rộng tối đa
        const MAX_CANVAS_HEIGHT = 300; // Chiều cao tối đa

        // Xử lý khi tải ảnh lên
        fileInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const imageURL = e.target.result;

                    // Hiển thị ảnh gốc
                    fabric.Image.fromURL(imageURL, function (img) {
                        originalImage = img;
                        const items = document.querySelectorAll('.canvas-item')
                        items.forEach(item => {
                            item.classList.remove('hidden');
                            item.classList.add('flex');
                        });
                        // Tính toán tỷ lệ giữ nguyên
                        const { scaledWidth, scaledHeight } = calculateScaledDimensions(img.width, img.height);
                        originalCanvas.setWidth(scaledWidth);
                        originalCanvas.setHeight(scaledHeight);
                        
                        img.scaleToWidth(scaledWidth);
                        originalCanvas.clear();
                        originalCanvas.add(originalImage);
                        originalCanvas.renderAll();
                    });

                    // Hiển thị ảnh chỉnh sửa
                    fabric.Image.fromURL(imageURL, function (img) {
                        editedImage = img;

                        // Tính toán tỷ lệ giữ nguyên
                        const { scaledWidth, scaledHeight } = calculateScaledDimensions(img.width, img.height);
                        editedCanvas.setWidth(scaledWidth);
                        editedCanvas.setHeight(scaledHeight);
                        
                        img.scaleToWidth(scaledWidth);
                        editedCanvas.clear();
                        editedCanvas.add(editedImage);
                    });
                };
                reader.readAsDataURL(file);
            }
        });

        // Điều chỉnh làm rõ/làm mờ
        sharpnessSlider.addEventListener('input', () => {
            const value = parseFloat(sharpnessSlider.value);
            sharpnessValueDisplay.textContent = value.toFixed(2);

            if (editedImage) {
                applySharpness(value);
            }
        });

        // Điều chỉnh phơi sáng/làm tối
        brightnessSlider.addEventListener('input', () => {
            const value = parseFloat(brightnessSlider.value);
            brightnessValueDisplay.textContent = value.toFixed(2);

            if (editedImage) {
                applyBrightness(value);
            }
        });

        // Hàm áp dụng làm rõ/làm mờ
        function applySharpness(value) {
            const matrix = value > 1 
                ? [
                    0, -0.2 * (value - 1), 0,
                    -0.2 * (value - 1), 1 + 0.8 * (value - 1), -0.2 * (value - 1),
                    0, -0.2 * (value - 1), 0
                ] 
                : [
                    1 / 9, 1 / 9, 1 / 9,
                    1 / 9, 1 / 9 - 0.1 * (1 - value), 1 / 9,
                    1 / 9, 1 / 9, 1 / 9
                ];

            const sharpnessFilter = new fabric.Image.filters.Convolute({ matrix });
            editedImage.filters[0] = sharpnessFilter; // Bộ lọc làm rõ/làm mờ
            editedImage.applyFilters();
            editedCanvas.renderAll();
        }

        // Hàm áp dụng phơi sáng/làm tối
        function applyBrightness(value) {
            const brightnessFilter = new fabric.Image.filters.Brightness({ brightness: value });
            editedImage.filters[1] = brightnessFilter; // Bộ lọc phơi sáng/làm tối
            editedImage.applyFilters();
            editedCanvas.renderAll();
        }

        // Tính toán tỷ lệ giữ nguyên
        function calculateScaledDimensions(width, height) {
            const widthRatio = MAX_CANVAS_WIDTH / width;
            const heightRatio = MAX_CANVAS_HEIGHT / height;
            const scale = Math.min(widthRatio, heightRatio);

            return {
                scaledWidth: width * scale,
                scaledHeight: height * scale
            };
        }

        // Tải về ảnh chỉnh sửa
        downloadBtn.addEventListener('click', () => {
            if (editedImage) {
                const dataURL = editedCanvas.toDataURL({
                    format: 'png',
                    quality: 1.0
                });

                const link = document.createElement('a');
                link.href = dataURL;
                link.download = 'edited-image.png';
                link.click();
            } else {
                alert('Vui lòng tải hình ảnh và chỉnh sửa trước!');
            }
        });
    </script>
@endsection