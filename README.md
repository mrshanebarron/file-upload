# Laravel Design File Upload

Drag and drop file upload component with previews for Laravel. Supports Livewire, Blade, and Vue 3.

## Installation

```bash
composer require mrshanebarron/file-upload
```


## Usage

### Livewire Component

```blade
<livewire:ld-file-upload />
```

### Blade Component

```blade
<x-ld-file-upload />
```

## Configuration

Publish the config file:

```bash
php artisan vendor:publish --tag=ld-file-upload-config
```

## Customization

### Publishing Views

```bash
php artisan vendor:publish --tag=ld-file-upload-views
```

## License

MIT
