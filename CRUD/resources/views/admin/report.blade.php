<x-app-layout>
    <x-slot name="layoutTitle">Centro de Reportes</x-slot>

    <x-slot name="slot">
        <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
            <div class="max-w-5xl mx-auto">
                
                
                <div class="mb-8">
                    <div class="flex items-center gap-2 text-sm text-gray-500 mb-1">
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-orange-500 transition-colors inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" /></svg>
                            Dashboard
                        </a>
                        <span>/</span>
                        <span class="font-medium text-gray-800">Reportes</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">Reportes de Ventas</h1>
                            <p class="text-gray-500 mt-1">Exporta datos financieros y operativos en formato PDF.</p>
                        </div>
                        <div class="p-3 bg-white rounded-full shadow-sm border border-gray-100 hidden sm:block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    
                    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                            <h2 class="text-lg font-bold text-gray-800 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                Reporte Personalizado
                            </h2>
                        </div>
                        
                        <div class="p-6">
                            <p class="text-sm text-gray-600 mb-6">Selecciona un rango de fechas específico para analizar el rendimiento de ventas en ese periodo.</p>
                            
                            <form action="{{ route('admin.report.generate') }}" method="POST">
                                @csrf
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                                    
                                    <div>
                                        <label for="start_date" class="block text-sm font-bold text-gray-700 mb-2">Fecha de inicio</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                            </div>
                                            <input type="date" id="start_date" name="start_date" class="pl-10 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition-colors" required>
                                        </div>
                                    </div>
                                    
                                    
                                    <div>
                                        <label for="end_date" class="block text-sm font-bold text-gray-700 mb-2">Fecha de fin</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                            </div>
                                            <input type="date" id="end_date" name="end_date" class="pl-10 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition-colors" required>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="w-full sm:w-auto bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-transform active:scale-95 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                                    Generar PDF Detallado
                                </button>
                            </form>
                        </div>
                    </div>

                    
                    <div class="lg:col-span-1">
                        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-lg text-white overflow-hidden relative">
                            
                            <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 rounded-full bg-white opacity-10 blur-xl"></div>
                            
                            <div class="p-6 relative z-10">
                                <h2 class="text-xl font-bold flex items-center mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    Cierre Rápido
                                </h2>
                                
                                <div class="bg-white/10 rounded-lg p-4 mb-6 backdrop-blur-sm border border-white/20">
                                    <p class="text-orange-100 text-xs uppercase font-bold tracking-wider mb-1">Fecha de hoy</p>
                                    <p class="text-3xl font-bold font-mono">{{ date('d M, Y') }}</p>
                                </div>

                                <p class="text-orange-50 text-sm mb-6">Descarga inmediatamente todas las ventas registradas hasta el momento en el día en curso.</p>

                                <form action="{{ route('admin.report.generate') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="daily_report" value="{{ date('Y-m-d') }}">
                                    <button type="submit" class="w-full bg-white text-orange-600 hover:bg-orange-50 font-bold py-3 px-4 rounded-lg shadow-md transition-colors flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" /></svg>
                                        Descargar Corte del Día
                                    </button>
                                </form>
                            </div>
                        </div>

                        
                        <div class="mt-6 bg-yellow-50 border border-yellow-100 rounded-lg p-4 flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-600 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" /></svg>
                            <p class="text-xs text-yellow-800">
                                <strong>Tip:</strong> Asegúrate de haber finalizado todos los pedidos en la sección de "Caja" para que aparezcan en el reporte.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>




























