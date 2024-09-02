<div class="row">
    <div class="col-md-12">
        <input type="hidden" name="id" value="{{ $topic->id }}" id="id_data" />
        <div class="form-group">
            <label for="dosen1_id">Dosen Pembimbing 1</label>
            <select class="form-control select2" name="dosen1_id" class="form-control " required autocomplete="dosen1_id"
                autofocus>
                <option value="{{ $topic->dosen1_id }}">Pilih Dosen Pembimbing 1</option>
                @foreach ($lecture as $dosen)
                    <option value="{{ $dosen->id }}">{{ $dosen->nama }} {{ $dosen->nama_b }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="dosen2_id">Dosen Pembimbing 2</label>
            <select class="form-control select2" name="dosen2_id" class="form-control " required
                autocomplete="dosen1_id" autofocus>
                <option value="{{ $topic->dosen2_id }}">Pilih Dosen Pembimbing 2</option>
                @foreach ($lecture as $dosen)
                    <option value="{{ $dosen->id }}">{{ $dosen->nama }} {{ $dosen->nama_b }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
