<tbody>
@foreach($products as $product)
    <tr>
        <td class="p-3 fs-13">
            <a href="{{route('product.details',$product->id)}}" class="btn btn-sm btn-outline-dark"><i class="fa fa-eye"></i></a>
            <button id="imageUploadModalBtn" class="btn btn-sm btn-outline-dark imageUploadModalBtn" data-id="{{$product->id}}"><i class="fa fa-arrow-up"></i></button>
        </td>
        <td class="p-3 fs-13">{{$product->sku ?? ''}}</td>
        <td class="p-3 fs-13">{{$product->name ?? ''}}</td>
        <td class="p-3 fs-13">{{$product->manufacturer ?? ''}}</td>
        <td class="p-3 fs-13">{{$product->country ?? ''}}</td>
        <td class="p-3 fs-13">{{$product->model_no ?? ''}}</td>
        <td class="p-3 fs-13">{{$product->mdma_no ?? ''}}</td>
        <td class="p-3 fs-13">{{$product->classification ?? ''}}</td>
        <td class="p-3 fs-13">
            {{ $product->width && $product->length && $product->height ? "{$product->width} x {$product->length} x {$product->height}" : '' }}
        </td>
        <td class="p-3 fs-13">Xoft House</td>
        <td class="p-3 fs-13">{{$product->price}}</td>
        <td class="p-3 fs-13">
            {{ $product->category->name ?? '-' }}
        </td>
        <td class="p-3 fs-13">
            {{ $product->subCategory->name ?? '-' }}
        </td>
        <td class="p-3 fs-13">
            {{ $product->subSubCategory->name ?? '-' }}
        </td>
        <td class="p-3 fs-13 d-flex">
            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-outline-dark d-inline-block">
                <i class="fa fa-pencil"></i>
            </a>
            <button  class="btn btn-sm btn-outline-dark d-inline-block deleteProductBtn" data-id="{{ $product->id }}">
                <i class="fa fa-trash"></i>
            </button>
        </td>

    </tr>
@endforeach
</tbody>
