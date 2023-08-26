<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Home</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
<x-app-layout>
<body>
    <div class="bg-blue-500 bg-opacity-50">
        <div style="text-align:center;" class="text-xl font-medium">
            <h1>個人情報編集</h1>
        </div>
        
        <br>
        
       <div class="flex flex-col">
            <form action="/index/{{ $post->id }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="_method" value="PUT">
                <div class="font-semibold flex flex-col ml-20">
                    <div class="post-email flex justify-start">
                        <div class="w-1/6"><h2>メールアドレス</h2></div>
                        <div><input type="text" name="post[email]" value="{{ $post->email }}"></div>
                        <div><p class="email-error" style="color:red">{{ $errors->first('post.email') }}</p></div>
                        
                    </div>
                    <br>
                    <div class="post-address flex justify-start">
                        <div class="w-1/6"><h2>住所</h2></div>
                        <div><input type="text" name="post[address]" value="{{ $post->address }}" ></div>
                        <div><p class="address-error" style="color:red">{{ $errors->first('post.address') }}</p></div>
                    </div>
                    <br>
                    <div class="post-tel flex justify-start">
                        <div class="w-1/6"><h2>電話番号</h2></div>
                        <div><input type="text" name="post[tel]" value="{{ $post->tel }}"></div>
                        <div><p class="tel-error" style="color:red">{{ $errors->first('post.tel') }}</p></div>
                    </div>
                     <br>
                    <div class="post-creditCardType flex justify-start">
                        <div class="w-1/6"><h2>クレジットカード種類</h2></div>
                        <div><input type="text" name="post[creditCardType]" value="{{ $post->creditCardType }}" ></div>
                        <div><p class="creditCardType-error" style="color:red">{{ $errors->first('post.creditCardType') }}</p></div>
                    </div>
                     <br>
                    <div class="post-creditCardNumber flex justify-start">
                        <div class="w-1/6"><h2>クレジットカード番号</h2></div>
                        <div><input type="text" name="post[creditCardNumber]" value="{{ $post->creditCardNumber }}" ></div>
                        <div><p class="creditCardNumber-error" style="color:red">{{ $errors->first('post.creditCardNumber') }}</p></div>
                    </div>
                    
                     <input type="hidden" name="post[user_id]" value="{{ $post->user_id }}">

                    <br>
        
                    <div id="app">
                        <div  class="flex justify-start" v-col="6">
                            <div class="w-1/6"><h2>サイト名/サイトURL</h2></div>
                            <!--既存のSite情報-->
                            <div v-for="sites in inputSites" :key="sites.id">
                                <!-- siteの内容を表示する処理 -->
                                <p class="w-1/6">  </p>
                                <input v-model="sites.site_name" :name="`sites[${sites.id}][site_name]`" type="text" @blur="validateSites">
                                <input v-model="sites.site_url" :name="`sites[${sites.id}][site_url]`" type="text" @blur="validateSites">
                                <input v-model="sites.id" :name="`sites[${sites.id}][id]`" type="hidden">
                                <input v-model="sites.post_id" :name="`sites[${sites.id}][post_id]`" type="hidden">
                            </div>
                        </div>
                        <!--新規追加分-->
                        <div class="flex justify-start" v-col="6">
                            <div class="w-1/6"><p>  </p></div>
                            <div v-for="(site, index) in newSites">
                                <input v-model="site.site_name" :name="`newSites[${index}][site_name]`" placeholder="サイト名" type="text" @blur="validateSites"/>
                                <input v-model="site.site_url" :name="`newSites[${index}][site_url]`" placeholder="サイトURL" type="text" @blur="validateSites"/>
                                <button @click.prevent="removeSite(index)" class="h-10 px-6 font-semibold rounded-md bg-black text-white">削除</button>
                            </div>
                            <br>
                        </div>
                        
                        <div class="flex justify-start">
                            <p class="w-1/6">  </p>
                            <button v-if="inputSites.length + newSites.length < 5" @click.prevent="addNewSite">
                                新しいサイトを追加
                            </button>
                        </div>
                       
                    </div>
                    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
                    <script>
                        var initialSites = @json($sites);
                        console.log(initialSites,'initialSites');
                    </script>
                    <script>
                        new Vue({
                            el: '#app',
                            data: {
                                newSites:  [
                                            { site_name: '', site_url: '' }
                                        ],
                                maxTextCount: 5,
                                inputSites: initialSites,
                                
                            },
                            methods: {
                                canAddMoreSites() {
                                    return (this.inputSites.length + this.newSites.length) < 5;
                                },
                                addNewSite() {
                                    if (this.canAddMoreSites()) {
                                        this.newSites.push({ site_name: '', site_url: '' });
                                    } else {
                                        alert('合計で最大5つまで追加できます。');
                                    }
                                },
                                removeSite(index) {
                                    this.newSites.splice(index, 1);
                                },
                                isDuplicate(site) {
                                    return this.inputSites.some(existingSite => (existingSite.site_name === site.site_name && existingSite.site_name !== "" && site.site_name !== "") && 
                                    (existingSite.site_url === site.site_url && existingSite.site_url !== "" && site.site_url !== ""));
                                },
                                validateSites() {
                                    for (let site of this.newSites) {
                                        if (this.isDuplicate(site)) {
                                            alert(`${site.site_name} および ${site.site_url} は既に存在します。`);
                                            site.site_name = '';
                                            site.site_url = '';
                                            return false;
                                        }
                                    }
                                    return true;
                                },
                            }
                        });
                    </script>
            </div>
        </div>
                    
        <br>
    
        <div style="text-align:center;" class="save-button">
            <button class="h-10 px-6 font-semibold rounded-md bg-black text-white">
                <input type="submit" value="保存"/>
            </button>
        </div>
                
        <br>
                
            </form>
        
        <div style="text-align:center;" class="footer">
            <a href="/index/{{ $post->id }}">戻る</a>
        </div>
       
        </div>
            
    </body>
    </x-app-layout>
</html>