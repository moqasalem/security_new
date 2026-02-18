<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض سعر - {{ $quotation['number'] ?? 'Q-2025-001' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/pages/quotation-customer-view.css') }}">
</head>
<body>
    @php
    // Dummy data (في التطبيق الحقيقي سيأتي من الداتابيز)
    $quotation = [
        'id' => 1,
        'number' => 'Q-2025-0145',
        'date' => '2025-02-12',
        'created_date' => '2025-02-10',
        'customer_name' => 'شركة الأمن المتطور للحراسات',
        'approved_by' => 'المدير التنفيذي - أحمد محمد',
        'status' => 'pending', // draft, pending, approved, rejected
    ];

    $items = [
        ['id' => 1, 'name' => 'حراسة أمنية - 8 ساعات يومياً', 'price' => 150, 'qty' => 30, 'total' => 4500],
        ['id' => 2, 'name' => 'خدمة نظافة شاملة - يومياً', 'price' => 180, 'qty' => 20, 'total' => 3600],
        ['id' => 3, 'name' => 'بدل مواصلات شهري', 'price' => 300, 'qty' => 10, 'total' => 3000],
        ['id' => 4, 'name' => 'معدات أمنية - كاميرات مراقبة', 'price' => 800, 'qty' => 5, 'total' => 4000],
    ];

    $subtotal = array_sum(array_column($items, 'total'));
    $tax = $subtotal * 0.15;
    $grandTotal = $subtotal + $tax;
    @endphp

    <div class="customer-page">
        <!-- Print Sheet -->
        <div class="print-sheet">
            <!-- Company Logo & Header -->
            <div class="sheet-header">
                <div class="logo-box">
                    <svg width="80" height="80" viewBox="0 0 100 100" fill="none">
                        <rect width="100" height="100" fill="#f3f4f6"/>
                        <text x="50" y="45" font-size="12" fill="#9ca3af" text-anchor="middle" font-family="Cairo, sans-serif">أضف</text>
                        <text x="50" y="65" font-size="12" fill="#9ca3af" text-anchor="middle" font-family="Cairo, sans-serif">شعارك</text>
                    </svg>
                </div>
                <div class="header-info">
                    <h1 class="quotation-title">عرض أسعار</h1>
                    <div class="info-row">
                        <div class="info-item">
                            <span class="info-label">رقم العرض:</span>
                            <span class="info-value">{{ $quotation['number'] }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">تاريخ إنشاء الصفقة:</span>
                            <span class="info-value">{{ $quotation['created_date'] }}</span>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-item">
                            <span class="info-label">التاريخ:</span>
                            <span class="info-value">{{ $quotation['date'] }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customer Info -->
            <div class="customer-section">
                <p class="customer-greeting">السادة / <strong>{{ $quotation['customer_name'] }}</strong></p>
                <p class="customer-intro">السلام عليكم ورحمة الله وبركاته،</p>
                <p class="customer-text">نتشرف بتقديم عرض أسعارنا لخدماتكم الكريمة، ونأمل أن ينال رضاكم وتقديركم.</p>
            </div>

            <!-- Items Table -->
            <div class="items-section">
                <table class="items-table">
                    <thead>
                        <tr>
                            <th style="width: 50px;">م</th>
                            <th>الصنف</th>
                            <th style="width: 120px;">السعر</th>
                            <th style="width: 100px;">الكمية</th>
                            <th style="width: 120px;">الإجمالي</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>{{ $item['id'] }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ number_format($item['price'], 2) }} ر.س</td>
                            <td>{{ $item['qty'] }}</td>
                            <td><strong>{{ number_format($item['total'], 2) }} ر.س</strong></td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="subtotal-row">
                            <td colspan="4">المجموع الفرعي:</td>
                            <td><strong>{{ number_format($subtotal, 2) }} ر.س</strong></td>
                        </tr>
                        <tr class="tax-row">
                            <td colspan="4">ضريبة القيمة المضافة (15%):</td>
                            <td><strong>{{ number_format($tax, 2) }} ر.س</strong></td>
                        </tr>
                        <tr class="total-row">
                            <td colspan="4">الإجمالي النهائي:</td>
                            <td><strong>{{ number_format($grandTotal, 2) }} ر.س</strong></td>
                        </tr>
                    </tfoot>
</table>
            </div>

            <!-- Approval Section -->
            <div class="approval-section">
                <p class="approved-by">تم تحديد هذا السعر من قبل: <strong>{{ $quotation['approved_by'] }}</strong></p>
            </div>

            <!-- Terms Section -->
            <div class="terms-section">
                <h3 class="terms-title">الشروط والأحكام:</h3>
                <ul class="terms-list">
                    <li>العرض صالح لمدة 30 يوماً من تاريخ الإصدار</li>
                    <li>الأسعار المذكورة شاملة لضريبة القيمة المضافة</li>
                    <li>الدفع خلال 15 يوم من تاريخ الفاتورة</li>
                    <li>يتم التنفيذ بعد توقيع العقد واستلام الدفعة المقدمة (30%)</li>
                    <li>أي تعديلات بعد الموافقة قد تؤدي لتغيير التسعير</li>
                </ul>
            </div>

            <!-- Customer Action Buttons -->
            @if($quotation['status'] === 'pending')
            <div class="customer-actions">
                <p class="action-prompt">يرجى اختيار أحد الخيارات التالية:</p>
                <div class="action-buttons">
                    <button class="btn btn--accept" id="btnAccept">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        قبول العرض
                    </button>
                    <button class="btn btn--reject" id="btnReject">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        رفض العرض
                    </button>
                </div>
            </div>
            @elseif($quotation['status'] === 'approved')
            <div class="status-message status-message--success">
                <svg width="48" height="48" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <h2>تم قبول العرض بنجاح!</h2>
                <p>شكراً لثقتكم، سيتم التواصل معكم قريباً لإتمام الإجراءات.</p>
            </div>
            @elseif($quotation['status'] === 'rejected')
            <div class="status-message status-message--rejected">
                <svg width="48" height="48" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <h2>تم رفض هذا العرض</h2>
                <p>إذا كان لديكم أي استفسارات أو ملاحظات، يرجى التواصل معنا.</p>
            </div>
            @endif

            <!-- Decorative Footer -->
            <div class="sheet-footer">
                <div class="footer-decoration">
                    <svg class="footer-shape" viewBox="0 0 800 120" preserveAspectRatio="none">
                        <rect x="0" y="0" width="800" height="120" fill="#0f2a44"/>
                        <polygon points="0,120 0,60 150,120" fill="#f2b705"/>
                        <circle cx="100" cy="40" r="8" fill="#f2b705" opacity="0.3"/>
                        <circle cx="130" cy="25" r="5" fill="#f2b705" opacity="0.5"/>
                        <rect x="160" y="15" width="12" height="12" fill="#f59e0b" opacity="0.4" transform="rotate(45 166 21)"/>
                    </svg>
                    
                    <div class="contact-info">
                        <div class="contact-item">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                            <span>+966 50 123 4567</span>
                        </div>
                        <div class="contact-item">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                            <span>info@security-company.com</span>
                        </div>
                        <div class="contact-item">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.556h3.936c-.093-1.414-.377-2.649-.766-3.556-.24-.56-.5-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.971 5c-.089-1.546-.383-2.97-.837-4.118A6.004 6.004 0 0115.917 9h-1.946zm-2.003 2H8.032c.093 1.414.377 2.649.766 3.556.24.56.5.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.498-.623.737-1.182.389-.907.673-2.142.766-3.556zm1.166 4.118c.454-1.147.748-2.572.837-4.118h1.946a6.004 6.004 0 01-2.783 4.118zm-6.268 0C6.412 13.97 6.118 12.546 6.03 11H4.083a6.004 6.004 0 002.783 4.118z" clip-rule="evenodd"/>
                            </svg>
                            <span>www.security-company.com</span>
                        </div>
                        <div class="contact-item">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                            <span>الرياض، المملكة العربية السعودية</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div class="modal" id="rejectModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h3 class="modal__title">رفض عرض السعر</h3>
                <button class="modal__close" aria-label="إغلاق">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            <div class="modal__body">
                <p class="modal__description">يرجى تحديد سبب الرفض (اختياري):</p>
                <textarea class="form-textarea" id="rejectionReason" rows="4" placeholder="أدخل سبب الرفض..."></textarea>
            </div>
            <div class="modal__footer">
                <button class="btn btn--outline modal__close">إلغاء</button>
                <button class="btn btn--danger" id="confirmRejectBtn">تأكيد الرفض</button>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast" id="toast" role="status" aria-live="polite">
        <div class="toast__icon">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
        </div>
        <div class="toast__message" id="toastMessage"></div>
    </div>

</body>
</html>

