const inputNameProduct = (i) => {
    return ` <div class="col-span-3 w-full mt-2">
    <label class="form-control w-full max-w-xs" for="loggingProductName${i}">
    <div class="label">
    <div>
    <span
        class="label-text
    ">Name</span>
    <span
        class="text-error
    ">*</span>
    </div>
    </div>
    </label>

    <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
        <input id="loggingProductName${i}" type="text"
            class="form-input grow border-none outline-none " name="products[`+i+`][name]"
            x-model="form.products[`+i+`].name" placeholder="Enter your product name"
            minlength="1" maxlength="50" />
    </label>

    <template x-if="isSubmitFormItem && form.products[`+i+`].name">
        <p class="text-[#1abc9c] mt-2 text-xs">Looks Good!</p>
    </template>

    <template x-if="isSubmitFormItem && !form.products[`+i+`].name">
        <p class="mt-2 text-error text-xs">Please fill the name</p>
    </template>
    </div>
    `;
}

const inputProfitProduct = (i) => {
    return `<div class="col-span-3 w-full mt-2">
    <label class="form-control w-full max-w-xs" for="loggingProductProfit${i}">
    <div class="label">
    <div>
    <span
        class="label-text
    ">Profit</span>
    <span
        class="text-error
    ">*</span>
    </div>
    </div>
    </label>

    <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
    <p class="text-sm text-gray-400">Rp.</p>
    <input id="loggingProductProfit${i}" type="text"
        class="form-input grow border-none outline-none "
        name="products[`+i+`][profit]" x-model="form.products[`+i+`].profit"
        placeholder="Enter your product profit" x-mask:dynamic="$money($input,',')" step="1000" minlength="1" maxlength="50" />
    </label>

    <template x-if="isSubmitFormItem && form.products[`+i+`].profit">
        <p class="text-[#1abc9c] mt-2 text-xs">Looks Good!</p>
    </template>

    <template x-if="isSubmitFormItem && !form.products[`+i+`].profit">
        <p class="mt-2 text-error text-xs">Please fill the profit</p>
    </template>
    </div>
    `;
}

const inputWeaverNameProduct = (i) => {
    return `<div class="col-span-3 w-full mt-2">
    <label class="form-control w-full max-w-xs" for="loggingProductWeaverName${i}">
    <div class="label">
    <div>
        <span
            class="label-text
        ">Weaver
            Name</span>
        <span
            class="text-error
        ">*</span>
    </div>
    </div>
    </label>

    <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
    <select
        class="dropDownWeaver form-input form-control grow border-none outline-none text-md font-extralight"
        id="loggingProductWeaverName${i}" name="products[`+i+`][weaver_name]"
        x-model="form.products[`+i+`].weaver_name">
        <option selected>Production weaver name</option>
    </select>
    </label>

    <template x-if="isSubmitFormItem && form.products[`+i+`].weaver_name">
        <p class="text-[#1abc9c] mt-2 text-xs">Looks Good!</p>
    </template>

    <template x-if="isSubmitFormItem && !form.products[`+i+`].weaver_name">
        <p class="mt-2 text-error text-xs">Please fill the weaver name</p>
    </template>
    </div>
    `;
}

const inputCategoryProduct = (i) => {
    return ` <div class="col-span-3 w-full mt-2">
    <label class="form-control w-full max-w-xs" for="loggingProductCategoryName${i}">
    <div class="label">
    <div>
        <span
            class="label-text
        ">Category
            Name</span>
        <span
            class="text-error
        ">*</span>
    </div>
    </div>
    </label>

    <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
    <input id="loggingProductCategoryName${i}" type="text"
        class="form-input grow border-none outline-none"
        name="products[`+i+`][category_name]" x-model="form.products[`+i+`].category_name"
        placeholder="Enter your product category name" minlength="1"
        maxlength="50" />
    </label>

    <template x-if="isSubmitFormItem && form.products[`+i+`].category_name">
        <p class="text-[#1abc9c] mt-2 text-xs">Looks Good!</p>
    </template>

    <template x-if="isSubmitFormItem && !form.products[`+i+`].category_name">
        <p class="mt-2 text-error text-xs">Please fill the category name</p>
    </template>
    </div>
    `;
}

 const buttonRemoveProduct = (i) => {
        return ` <div class="col-span-1 w-full mt-8">
            <button type="button" id=btn-remove-product-` + i + ` class="btn btn-sm btn-error text-white" x-on:click="removeProductForm(${i})">Remove</button>
            </div>`
    }

const formParentProduct = (i) => {
    return `<div class="grid lg:grid-cols-7 grid-cols-2 place-items-center place-content-center gap-4 border-t border-t-gray-800  " id="formParentProduct${i}">
    ${inputNameProduct(i)}
    ${inputProfitProduct(i)}
    ${inputWeaverNameProduct(i)}
    ${inputCategoryProduct(i)}
    ${buttonRemoveProduct(i)}
    </div>
    `;
}

