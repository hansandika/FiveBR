<div class="mb-4">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control @error('title')is-invalid @enderror" name="title"
        value="{{ old('title') ?? $gig->title }}">
    @error('title')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="mb-4">
    <label for="about" class="form-label">About</label>
    <textarea class="form-control @error('about')is-invalid @enderror" name="about"
        rows="7">{{ old('about') ?? $gig->about }}</textarea>
    @error('about')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="mb-4">
    <label for="category" class="form-label">Category</label>
    <select class="form-select" name="category">
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ $category->id == $gig->category_id ? 'selected' : '' }}>
                {{ $category->name }}</option>
        @endforeach
    </select>
</div>
<div class="row mb-4">
    <div class="col-md-4">
        <label for="basic_price" class="form-label">Basic Price</label>
        <div class="input-group @error('basic_price')is-invalid @enderror">
            <span class="input-group-text">$</span>
            <input type="text" class="form-control @error('basic_price')is-invalid @enderror" name="basic_price"
                value="{{ old('basic_price') ?? $gig->basic_price }}">
        </div>
        @error('basic_price')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="standard_price" class="form-label">Standard Price</label>
        <div class="input-group  @error('standard_price')is-invalid @enderror">
            <span class="input-group-text">$</span>
            <input type="text" class="form-control @error('standard_price')is-invalid @enderror" name="standard_price"
                value="{{ old('standard_price') ?? $gig->standard_price }}">
        </div>
        @error('standard_price')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="premium_price" class="form-label">Premium Price</label>
        <div class="input-group @error('premium_price')is-invalid @enderror">
            <span class="input-group-text">$</span>
            <input type="text" class="form-control @error('premium_price')is-invalid @enderror" name="premium_price"
                value="{{ old('premium_price') ?? $gig->premium_price }}">
        </div>
        @error('premium_price')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
<div class="row mb-4">
    <div class="col-md-4">
        <label for="basic_description" class="form-label">Basic Price Description</label>
        <textarea class="form-control @error('basic_description')is-invalid @enderror" name="basic_description"
            rows="7">{{ old('basic_description') ?? $gig->basic_description }}</textarea>
        @error('basic_description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="standard_description" class="form-label">Standard Price Description</label>
        <textarea class="form-control @error('standard_description')is-invalid @enderror" name="standard_description"
            rows="7">{{ old('standard_description') ?? $gig->standard_description }}</textarea>
        @error('standard_description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="premium_description" class="form-label">Premium Price Description</label>
        <textarea class="form-control @error('premium_description')is-invalid @enderror" name="premium_description"
            rows="7">{{ old('premium_description') ?? $gig->premium_description }}</textarea>
        @error('premium_description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
<div class="mb-4">
    <label for="image[]" class="form-label">Images</label>
    <input class="form-control" type="file" name="images[]" multiple>
</div>
<button type="submit" class="btn btn-primary form-control">Submit</button>
