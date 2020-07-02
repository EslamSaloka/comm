@extends('DCommon::master')
@section('title',__('Locale'))
@section('content')
@push('styles')
<style>
    .activeme {
        background: #3f51b51f;
        border-radius: 7px;
        padding: 10px;
    }
    .top_header {
        position: sticky;
        top: 0;
        background: #fff;
        overflow: hidden;
        width: 100%;
        z-index: 999;
        border-bottom: 1px solid #e3e3e3;
    }
</style>
@endpush
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-flat" id="page_layout">
            <div class="top_header">
                <div class="panel-heading" style="margin-top: 16px;">
                    <input type="text" placeholder="@lang('Search')" class="form-control" v-model="searchValue" style=" width: 310px; position: absolute; top: 9px; right: 87px; "/>
                    <div class="heading-elements">
                        <button type="submit" class="btn btn-primary mb-10" @click.prevent="Save()">
                            @lang("Save")
                            <i class="icon-arrow-left13 position-right"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-12" style="margin-bottom: 9px;">
                    <div class="local_append content-group">
                        <div class="form-group ">
                            <div class="col-lg-10">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control" v-model="index">
                                    </div>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control" v-model="title">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="btn btn-primary" @click.prevent="AddNewRow()"> @lang('Add') </div>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
            <div class="panel-body">
                {{-- start here --}}
                <div class="col-md-12" v-for="(value, index) of filteredTitle">
                    <div class="local_append content-group" v-bind:class="{ 'activeme':value.classAtive }">
                        <div class="form-group ">
                            <div class="col-lg-10">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <input type="text" @change="addEvent" :id="index" placeholder="index" class="form-control" :value="value.index">
                                    </div>
                                    <div class="col-lg-5">
                                        <input type="text" @change="addEvent" :id="index" placeholder="title" class="form-control" :value="value.title">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="btn btn-danger delete" @click.prevent="deleteRow(index)"> @lang('Delete') </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>    
                </div>
                {{-- end here --}}
            </div>
        </div>
    </div>
</div>
{!! vue_srcs() !!}
@push('scripts')
<script>
    var locale_index = "{{ route('dashboard.locale.store') }}";
    var locale_store = "{{ route('dashboard.locale.show',1) }}";
    new Vue({
        el: '#page_layout',
        data: {
            index: '',
            title: '',
            searchValue: '',
            localeList: [],
        },
        methods: {
            addEvent: function({type,target}) {
                _this = this;
                // console.log(type);
                // console.log(target.value);
                // console.log(target.id);
                // console.log(target.placeholder);
                _this.localeList[target.id][target.placeholder] = target.value;
            },
            AddNewRow: function () {
                if (this.index.trim() == "" || this.title.trim() == "") {
                    alert('برجاء إدخال كلفه البيانات');
                } else {
                    var check_index = this.localeList.filter((function (value) {
                        return value.index.toLowerCase().includes(this.index.toLowerCase());
                    }).bind(this));
                    this.localeList.unshift({'index': this.index, 'title': this.title, 'classAtive': true});
                    this.index = '';
                    this.title = '';
                }
            },
            deleteRow: function (index) {
                if (confirm("Are You Shore To Delete")) {
                    this.localeList.splice(index, 1);
                }
            },
            Save: function () {
                if (confirm("Are You Shore To Save")) {
                    _this = this;
                    axios.post(locale_index, {
                        locale: _this.localeList,
                        _token: _token
                    }).then(function (response) {
                        if (response.data == true) {
                            alert('تم حفظ البيانات');
                        }
                    });
                }
            }
        },
        created: function () {
            _this = this;
            axios.get(locale_store)
                .then(function (response) {
                    _this.localeList = response.data;
                });
        },
        watch: {
            index: function (index) {
                this.index = index;
            },
            title: function (title) {
                this.title = title;
            },
            searchValue: function (value) {
                this.searchValue = value;
            }
        },
        computed: {
            filteredTitle: function () {
                _this = this;
                if (_this.searchValue === "") {
                    return _this.localeList;
                } else {
                    return _this.localeList.filter((function (value) {
                        return value.title.toLowerCase().includes(this.searchValue.toLowerCase()) || value.index.toLowerCase().includes(this.searchValue.toLowerCase());
                    }).bind(this));
                }
            }
        }
    });
</script>
@endpush
@endsection