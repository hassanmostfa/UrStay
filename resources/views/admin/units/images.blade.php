<!-- resources/views/components/image-gallery.blade.php -->

<div class="container mt-2">
    <div class="row">
        @foreach($images as $image)
            <div class="col-md-1 mb-4">
                <img src="{{ asset($image) }}" class="img-thumbnail" alt="Image" data-toggle="modal" data-target="#imageModal" data-img="{{ asset($image) }}">
            </div>
        @endforeach
    </div>

    <!-- Modal -->
    <div class="modal fade" style="z-index: 999999999999999" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" class="img-fluid" alt="Large Image">
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // document.addEventListener('DOMContentLoaded', function() {
    //     $('#imageModal').on('show.bs.modal', function (event) {
    //         var button = $(event.relatedTarget); // Button that triggered the modal
    //         var imgSrc = button.data('img'); // Extract info from data-* attributes
    //         var modal = $(this);
    //     });
    // });
    $('.img-thumbnail').on('click', function() {
        $('#modalImage').attr('src', $(this).attr('src')); // Update the modal's content
    })
</script>
