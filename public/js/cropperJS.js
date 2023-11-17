function base64toFile(dataURI, fileName) {
    const byteString = atob(dataURI.split(',')[1]);
    const mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
    const ab = new ArrayBuffer(byteString.length);
    const ia = new Uint8Array(ab);
    for (let i = 0; i < byteString.length; i++) {
        ia[i] = byteString.charCodeAt(i);
    }
    return new File([ab], fileName, { type: mimeString });
}

const $modal = $('#modal');
const image = document.getElementById('image');
let cropper;
let ratio = 5 / 2.5;

$("body").on("change", "#salesImage", function (e) {
    ratio = 1/1;
    const files = e.target.files;
    const done = function (url) {
        image.src = url;
        $modal.modal('show');
    };

    let reader;
    let file;
    document.getElementById('modal').classList.remove('hidden');
    if (files && files.length > 0) {
        file = files[0];

        if (URL) {
            done(URL.createObjectURL(file));
        } else if (FileReader) {
            reader = new FileReader();
            reader.onload = function (e) {
                done(reader.result);
            };
            reader.readAsDataURL(file);
        }
    }
});

$modal.on('shown.bs.modal', function () {
    cropper = new Cropper(image, {
        aspectRatio: ratio,
        viewMode: 3,
        preview: '.preview'
    });
}).on('hidden.bs.modal', function () {
    document.getElementById('modal').classList.add('hidden');
    if (cropper) {
        cropper.destroy();
        cropper = null;
    }
});

$("#crop").click(function () {
    if (cropper) {
        const canvas = cropper.getCroppedCanvas({
            width: 160,
            height: 160,
        });

        var croppedImage = document.getElementById('croppedImage');
        croppedImage.src = canvas.toDataURL('image/jpeg');
        document.getElementById('input-image').classList.add('hidden');
        document.getElementById('input-image').classList.remove('flex');
        document.getElementById('preview-image').classList.remove('hidden');
        document.getElementById('preview-image').classList.add('flex');
        canvas.toBlob(function (blob) {
            const url = URL.createObjectURL(blob);
            const reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function () {
                const base64data = reader.result;
                const fileName = "temporaryfile.png";
                const dataKu = base64toFile(base64data, fileName);
                $modal.modal('hide');
                document.getElementById('modal').classList.add('hidden');
                $('#salesImageCropped').val(base64data);
            };
        });
    }
});
