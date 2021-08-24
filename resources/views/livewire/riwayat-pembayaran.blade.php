<div>
        <div class="card" id="daftar-nasabah">
            <div class="card-header">
                <label class="label_filter" for="filter">Filter By : </label>
                <select id="filter" name="filter" class="filter" wire:model="filter">
                    @foreach (config('app.riwayatPembayaran') as $value)
                        <option value="{{ $value }}" >{{ str_replace('_',' ',$value) }}</option>
                    @endforeach
                </select>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0" id="table-content">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th style="width: 10px">No</th>
                    @foreach (config('app.riwayatPembayaran') as $value)
                        <th>
                            {{ str_replace('_',' ',$value) }}
                        </th>
                    @endforeach
                  </tr>
                </thead>
                <tbody>
                    @foreach ($data as $dt)
                    <tr>
                        <td>{{ $loop->index }}</td>
                        @foreach (config('app.riwayatPembayaran') as  $val)
                            <td>
                                {{ $dt[$val] }}
                            </td>
                        @endforeach
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
                          @if (abs($current - $i) > 2 and abs($current - $i) < $page-2)
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
                          <li onclick="Livewire.emit('next')">
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
