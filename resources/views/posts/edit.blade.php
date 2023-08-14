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
                    <br>
                    <div class="post-site_name flex justify-start">
                        <div class="w-1/6"><h2>サイト名</h2></div>
                        <div><input type="text" name="post[site_name]" value="{{ $post->site_name }}" ></div>
                        <div><p class="site_name-error" style="color:red">{{ $errors->first('post.site_name') }}</p></div>
                        
                    </div>
                    <br>
                    <div class="post-site_url flex justify-start">
                        <div class="w-1/6"><h2>サイトURL</h2></div>
                        <div><input type="text" name="post[site_url]" value="{{ $post->site_url }}" ></div>
                        <div><p class="site_url-error" style="color:red">{{ $errors->first('post.site_url') }}</p></div>
                        
                    </div>
                    <br>
                    <div id="app">

                        <!-- 入力ボックスを表示する場所 ① -->
                        <div v-for="(text,index) in texts">
                            <!-- 各入力ボックス -->
                            <input ref="texts"
                                   type="text"
                                   v-model="texts[index]"
                                   @keypress.shift.enter="addInput">
                            <!-- 入力ボックスの削除ボタン -->
                            <button type="button" @click="removeInput(index)">削除</button>
                        </div>
                    
                        <!-- 入力ボックスを追加するボタン ② -->
                        <button type="button" @click="addInput" v-if="!isTextMax">
                            追加する
                            （残り<span v-text="remainingTextCount"></span>件）
                        </button>
                        <br><br>
                        Ctrl + Enterキーで入力項目を追加できます（ショートカット）
                    
                        <!-- 入力されたデータを送信するボタン ③ -->
                        <br><br>
                        <button type="button" @click="onSubmit">送信する</button>
                    
                        <!-- 確認用 -->
                        <hr>
                        <label>textsの中身</label>
                        <div v-text="texts"></div>
                    
                    </div>
                    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
                    <script>
                    
                        new Vue({
                            el: '#app',
                            data: {
                                texts: [], // 複数入力のデータ（配列）,
                                maxTextCount: 5
                            },
                            methods: {
                                // ボタンをクリックしたときのイベント ①〜③
                                addInput() {
                    
                                    if(this.isTextMax) {
                    
                                        return;
                    
                                    }
                    
                                    this.texts.push(''); // 配列に１つ空データを追加する
                    
                                    Vue.nextTick(() => {
                    
                                        const maxIndex = this.texts.length - 1;
                                        console.log(maxIndex)
                                        this.$refs['texts'][maxIndex].focus(); // 追加された入力ボックスにフォーカスする
                    
                                    });
                    
                                },
                                removeInput(index) {
                    
                                    this.texts.splice(index, 1);
                    
                                },
                                onSubmit() {
                    
                                    const url = '/index/2/edit';
                                    const params = {
                                        texts: this.texts
                                    };
                                    axios.post(url, params)
                                        .then(response => {
                    
                                            // 成功した時
                    
                                        })
                                        .catch(error => {
                    
                                            // 失敗した時
                    
                                        });
                    
                                }
                            },
                            computed: {
                                isTextMax() {
                    
                                    return (this.texts.length >= this.maxTextCount);
                    
                                },
                                remainingTextCount() {
                    
                                    return this.maxTextCount - this.texts.length; // 追加できる残り件数
                    
                                }
                            }
                        });
                    
                    </script>
                    <div>
                        <input type="hidden" name="post[user_id]" value="{{ $post->user_id }}">
                    </div>
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