<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WhatsApp Blast - Tailwind CSS</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        whatsapp: {
                            light: '#DCF8C6',
                            DEFAULT: '#25D366',
                            dark: '#128C7E',
                            darker: '#075E54',
                            lightblue: '#34B7F1',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 font-sans min-h-screen flex items-center justify-center p-4 md:p-8">
    <div class="w-full max-w-md bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-whatsapp text-white p-6 relative">
            <div class="absolute top-4 left-4 flex items-center gap-1">
                <div class="w-6 h-6 bg-white rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#25D366">
                        <path d="M17.498 14.382c-.301-.15-1.767-.867-2.04-.966-.273-.101-.473-.15-.673.15-.197.295-.771.964-.944 1.162-.175.195-.349.21-.646.075-.3-.15-1.263-.465-2.403-1.485-.888-.795-1.484-1.77-1.66-2.07-.174-.3-.019-.465.13-.615.136-.135.301-.345.451-.523.146-.181.194-.301.297-.496.1-.21.049-.375-.025-.524-.075-.15-.672-1.62-.922-2.206-.24-.584-.487-.51-.672-.51-.172-.015-.371-.015-.571-.015-.2 0-.523.074-.797.359-.273.3-1.045 1.02-1.045 2.475s1.07 2.865 1.219 3.075c.149.195 2.105 3.195 5.1 4.485.714.3 1.27.48 1.704.629.714.227 1.365.195 1.88.12.574-.091 1.767-.721 2.016-1.426.255-.705.255-1.29.18-1.425-.074-.135-.27-.21-.57-.345m-5.446 7.443h-.016c-1.77 0-3.524-.48-5.055-1.38l-.36-.214-3.75.975 1.005-3.645-.239-.375c-.99-1.576-1.516-3.391-1.516-5.26 0-5.445 4.455-9.885 9.942-9.885 2.654 0 5.145 1.035 7.021 2.91 1.875 1.859 2.909 4.35 2.909 6.99-.004 5.444-4.46 9.885-9.935 9.885M20.52 3.449C18.24 1.245 15.24 0 12.045 0 5.463 0 .104 5.334.101 11.893c0 2.096.549 4.14 1.595 5.945L0 24l6.335-1.652c1.746.943 3.71 1.444 5.71 1.447h.006c6.585 0 11.946-5.336 11.949-11.896 0-3.176-1.24-6.165-3.495-8.411"/>
                    </svg>
                </div>
            </div>
            <h1 class="text-2xl font-semibold text-center">WhatsApp Blast</h1>
            <p class="text-sm text-center opacity-90">Send messages to multiple recipients</p>
        </div>
        
        <div class="p-6">
            <form action="{{ route('send.whatsapp.blast') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-2">
                        <span class="inline-block mr-1">📱</span>Recipient Number
                    </label>
                    <input 
                        type="text" 
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-whatsapp/20 focus:border-whatsapp transition-all duration-200" 
                        name="phone_number" 
                        id="phone_number" 
                        placeholder="e.g. 628123456789" 
                        required
                    >
                    <p class="mt-1 text-xs text-gray-500">Enter the phone number with country code without '+' or '0'</p>
                </div>

                <div class="mb-6">
                    <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                        <span class="inline-block mr-1">📎</span>Attachment
                    </label>
                    <div class="relative">
                        <label for="file" class="cursor-pointer w-full bg-gray-50 border border-gray-300 border-dashed rounded-lg py-3 px-4 flex items-center justify-center text-gray-600 hover:bg-gray-100 transition-all duration-200">
                            <span id="file-label">Choose a file</span>
                        </label>
                        <input 
                            type="file" 
                            class="hidden" 
                            name="file" 
                            id="file" 
                            required
                        >
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Maximum file size: 10MB</p>
                </div>

                <div class="mb-6">
                    <label for="media_type" class="block text-sm font-medium text-gray-700 mb-2">
                        <span class="inline-block mr-1">📊</span>Media Type
                    </label>
                    <div class="relative">
                        <select 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-whatsapp/20 focus:border-whatsapp transition-all duration-200 appearance-none bg-no-repeat" 
                            name="media_type" 
                            id="media_type" 
                            required
                            style="background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2214%22%20height%3D%2214%22%20viewBox%3D%220%200%2020%2020%22%20fill%3D%22none%22%3E%3Cpath%20d%3D%22M7%207l3-3%203%203m0%206l-3%203-3-3%22%20stroke%3D%22%239CA3AF%22%20stroke-width%3D%221.5%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%2F%3E%3C%2Fsvg%3E'); background-position: right 1rem center;"
                        >
                            <option value="">Select media type</option>
                            <option value="image">Image</option>
                            <option value="document">Document</option>
                        </select>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="caption" class="block text-sm font-medium text-gray-700 mb-2">
                        <span class="inline-block mr-1">✏️</span>Message Caption
                    </label>
                    <textarea 
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-whatsapp/20 focus:border-whatsapp transition-all duration-200 min-h-[100px] resize-y" 
                        name="caption" 
                        id="caption" 
                        placeholder="Type your message here..."
                    ></textarea>
                </div>

                <button 
                    type="submit" 
                    class="w-full bg-whatsapp hover:bg-whatsapp-dark text-white font-medium py-3 px-4 rounded-lg transition-all duration-200 flex items-center justify-center gap-2 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 active:translate-y-0"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>
                    Send WhatsApp
                </button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('file').addEventListener('change', function() {
            const fileName = this.files[0] ? this.files[0].name : 'Choose a file';
            document.getElementById('file-label').textContent = fileName;
        });
    </script>
</body>
</html>