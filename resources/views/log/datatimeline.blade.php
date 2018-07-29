@foreach($datas as $key=>$data)
              <li class="time-label">
                      <span class="bg-maroon">
                        {{$key}}
                      </span>
              </li>
              @foreach($data as $subdata)
                      <li>
                        @if ($subdata->category=="add")
                          <i class="fa fa-plus-circle bg-green"></i>
                        @elseif ($subdata->category=="edit")
                          <i class="fa fa-minus-circle bg-yellow"></i>
                        @elseif ($subdata->category=="delete")
                          <i class="fa fa-times-circle bg-red"></i>
                        @elseif ($subdata->category=="login")
                          <i class="fa fa-chevron-circle-right bg-blue"></i>
                        @else
                          <i class="fa fa-chevron-circle-left bg-purple"></i>
                        @endif

                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> {{date('H:i:s',strtotime($subdata->created_at))}}</span>

                          
                          @if ($subdata->category=="add")
                            <h3 class="timeline-header">Menambah</h3>
                          @elseif ($subdata->category=="edit")
                            <h3 class="timeline-header">Mengedit</h3>
                          @elseif ($subdata->category=="delete")
                            <h3 class="timeline-header">Menghapus</h3>
                          @elseif ($subdata->category=="login")
                            <h3 class="timeline-header">Login</h3>
                          @else
                            <h3 class="timeline-header">Logout</h3>
                          @endif


                          <div class="timeline-body">
                            {{$subdata->log}}
                          </div>
                        </div>
                      </li>
              @endforeach
                      
            @endforeach