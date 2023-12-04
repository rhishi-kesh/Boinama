<div>
    <div class="col-12 align-self-start">
        <div class="card">
            <div class="card-header">
                <h5>All Subjects</h5>
            </div>
            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="table-responsive px-4 pb-3">
                        <table class="table text-center mb-3">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $item = 0;
                                @endphp
                                @forelse ($subjects as $key => $subject)
                                <tr>
                                    <td>{{ ++$item }}</td>
                                    <td>{{ $subject->name }}</td>
                                    <td class="switch-sm">
                                        <label class="switch">
                                            <input type="checkbox" wire:change="status({{ $subject->id }})" @if($subject->status == 0) checked @endif>
                                            <span class="switch-state"></span>
                                        </label>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-danger" colspan="20">No Data Found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
