<div class="container mt-2 pb-5 px-4  mx-auto">
  <div class="row mx-auto d-flex  justify-content-center">
    <div class="col-lg-8 mb-3">
      <div class="w-100">
        <img src="https://picsum.photos/500/300?random=1" class="w-100 rounded d-block object-fit-cover" alt="">
      </div>
      <h4 class="my-4 fw-semibold text-center">Lorem, ipsum dolor.</h4>
      <p class="fs-5 mt-2 lead">Lorem ipsum do sunt ullam fugiat excepturi ad error pariatur?</p>
      <div class="mt-5 mb-4 d-flex justify-content-between">
        <span>0 komentar</span>
        <small class="text-muted">Lorem, ipsum dolor. years ago</small>
      </div>
      <form action="" method="post">
        <!-- @csrf -->
        <hr />
        <div class="mb-3">
          <!-- {{-- <label for="exampleFormControlTextarea1" class="form-label">Komentar</label> --}} -->
          <textarea placeholder="tambahkan komentar" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <!-- @auth -->
        <button type="submit" class="btn btn-primary">komentar</button>
        <!-- @else -->
        <a class="btn btn-primary" style="opacity: 60%;" href="{{ route('login') }}">login untuk komentar</a>
      </form>
      <!-- {{-- komentar --}} -->
      <!-- <div class="mt-4">
        <div class="card mb-2 shadow border-0">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class=" flex-shrink-1">
                <div class="h-50 w-50 ">
                  <img src="/img/logo.png" width="30" class=" rounded d-block object-fit-cover" alt="">
                </div>
              </div>
              <div class=" w-100">
                <p class="ps-3 fs-6">Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi
                  cumque
                  temporibus quis? Lorem, ipsum dolor sit amet consectetur adipisicing elit. Modi odit
                  sint recusandae.
                </p>
              </div>
            </div>

          </div>
          <div class="position-absolute bottom-0 end-0">
            <small class="px-2 d-block mb-1">years ago</small>
          </div>
        </div>
      </div> -->
    </div>
  </div>
</div>