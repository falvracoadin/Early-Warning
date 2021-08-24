<div>

<div class="card" id="daftar-nasabah">
    <div class="card-header">
        <label class="label_filter" for="filter">Filter By : </label>
        <select id="filter" name="filter" class="filter" wire:model="filter">
            <option value="default" >Default</option>
            <option value="nama">Nama</option>
            <option value="nik">NIK</option>
            <option value="pekerjaan">Pekerjaan</option>
            <option value="usia">Usia</option>
            <option value="besar_pinjaman">Besar Pinjaman</option>
            <option value="lama_tenor">Lama Tenor</option>
        </select>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0" id="table-content">
      <table class="table table-striped">
        <thead>
          <tr>
            <th style="width: 10px">No</th>
            <th>Nama</th>
            <th>NIK</th>
            <th>Pekerjaan</th>
            <th>Usia</th>
            <th>Besar Pinjaman</th>
            <th>Lama Tenor</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($data as $nasabah)

                <tr>
                    <td>{{ $loop->index + 1 }}.</td>
                    <td>{{ $nasabah['nama']}}</td>
                    <td>{{ $nasabah['nik'] }}</td>
                    <td>{{ $nasabah['pekerjaan'] }}</td>
                    <td>{{ $nasabah['usia'] }}</td>
                    <td>Rp. {{ number_format($nasabah['besar_pinjaman'],0, ',','.') }},-</td>
                    <td>{{ $nasabah['lama_tenor'] }}</td>
                </tr>

            @endforeach


        </tbody>
      </table>

    </div>

    @if ($total > 0)
      <nav>
          <ul class="pagination">
              {{-- Previous Page Link --}}
              @if ($current == 1)
                  <li class="disabled">&lsaquo;</span>
                  </li>
              @else
                  <li onclick="Livewire.emit('prev')">
                      &lsaquo;
                  </li>
              @endif

              {{-- Pagination Elements --}}
              @for ($i=1;$i<=$page;$i++)
                  {{-- "Three Dots" Separator --}}
                  @if (abs($current - $i) > 2 and abs($current - $i) < $page - 2 )
                      <li class="disabled" aria-disabled="true">
                          <span>.</span>
                      </li>
                  @elseif ($current == $i)
                      <li class="active" aria-current="page">
                          <span>{{ $current }}</span>
                      </li>
                  @else
                      <li onclick="Livewire.emit('getPage',{{ $i }})">{{ $i }}</li>
                  @endif

              @endfor

              {{-- Next Page Link --}}
              @if ($current < $page)
                  <li wire:click="$emitSelf('next')">
                      &rsaquo;
                  </li>
              @else
                  <li class="disabled" aria-disabled="true">
                      <span aria-hidden="true">&rsaquo;</span>
                  </li>
              @endif
          </ul>
      </nav>
  @endif
</div>
</div>
