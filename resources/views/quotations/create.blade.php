@extends('layouts.app')

@section('title', 'إنشاء عرض سعر')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/quotations-create.css') }}">
@endpush

@section('content')
    @php
    // Dummy customers
    $customers = [
        ['id' => 1, 'name' => 'شركة النور للأمن', 'phone' => '0501234567', 'email' => 'info@alnoor.com'],
        ['id' => 2, 'name' => 'مؤسسة الفجر', 'phone' => '0551234567', 'email' => 'contact@alfajr.com'],
        ['id' => 3, 'name' => 'شركة البناء المتقدم', 'phone' => '0561234567', 'email' => 'info@albina.com'],
        ['id' => 4, 'name' => 'مجموعة الرواد', 'phone' => '0501234568', 'email' => 'sales@alrawad.com'],
    ];

    // Dummy branches
    $branches = [
        ['id' => 1, 'name' => 'الفرع الرئيسي'],
        ['id' => 2, 'name' => 'فرع الملك فهد'],
        ['id' => 3, 'name' => 'فرع العليا'],
    ];

    // Dummy item templates
    $templates = [
        ['id' => 1, 'name' => 'حراسة أمنية - 8 ساعات', 'type' => 'security', 'price' => 150],
        ['id' => 2, 'name' => 'حراسة أمنية - 12 ساعة', 'type' => 'security', 'price' => 200],
        ['id' => 3, 'name' => 'خدمات نظافة شهرية', 'type' => 'cleaning', 'price' => 5000],
        ['id' => 4, 'name' => 'بدل مواصلات', 'type' => 'allowance', 'price' => 300],
    ];

    // Dummy previous quotations
    $previousQuotes = [
        ['id' => 1, 'number' => 'Q-2024-001', 'customer' => 'شركة النور للأمن', 'items_count' => 5],
        ['id' => 2, 'number' => 'Q-2024-002', 'customer' => 'مؤسسة الفجر', 'items_count' => 3],
    ];
    @endphp

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header__left">
            <h1 class="page-title">إنشاء عرض سعر</h1>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">الرئيسية</a>
                <span>/</span>
                <a href="{{ route('quotations') }}">عروض الأسعار</a>
                <span>/</span>
                <span>إنشاء</span>
            </nav>
        </div>
        <div class="page-header__right">
            <button class="btn btn--outline" id="cancelBtn">إلغاء</button>
            <button class="btn btn--outline" id="previewPdfBtn">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                </svg>
                معاينة PDF
            </button>
            <button class="btn btn--outline" id="saveDraftBtn">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z"/>
                </svg>
                حفظ كمسودة
            </button>
            <button class="btn btn--primary" id="sendForApprovalBtn">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/>
                </svg>
                إرسال للاعتماد
            </button>
        </div>
    </div>

    <!-- Wizard Stepper -->
    <div class="stepper">
        <div class="stepper__step active" data-step="1">
            <div class="stepper__number">1</div>
            <div class="stepper__label">بيانات العميل والمشروع</div>
        </div>
        <div class="stepper__line"></div>
        <div class="stepper__step" data-step="2">
            <div class="stepper__number">2</div>
            <div class="stepper__label">البنود والتسعير</div>
        </div>
        <div class="stepper__line"></div>
        <div class="stepper__step" data-step="3">
            <div class="stepper__number">3</div>
            <div class="stepper__label">الشروط والملاحظات</div>
        </div>
        <div class="stepper__line"></div>
        <div class="stepper__step" data-step="4">
            <div class="stepper__number">4</div>
            <div class="stepper__label">المراجعة والإرسال</div>
        </div>
    </div>

    <!-- Wizard Content -->
    <div class="wizard-content">
        
        <!-- Step 1: Customer & Project Info -->
        <div class="wizard-step active" id="step1">
            <div class="form-card">
                <h3 class="form-card__title">بيانات العميل والمشروع</h3>
                
                <div class="form-group">
                    <label class="form-label">رقم العرض <span class="auto-label">سيتم توليده تلقائياً</span></label>
                    <input type="text" class="form-input" value="Q-2024-013" disabled>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">اختر العميل <span class="required">*</span></label>
                        <select class="form-input" id="customerSelect" required>
                            <option value="">-- اختر العميل --</option>
                            @foreach($customers as $customer)
                            <option value="{{ $customer['id'] }}">{{ $customer['name'] }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn--text btn--sm" id="quickAddCustomerBtn" style="margin-top: 8px;">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                            </svg>
                            إضافة عميل سريع
                        </button>
                    </div>

                    <div class="form-group">
                        <label class="form-label">الفرع <span class="required">*</span></label>
                        <select class="form-input" id="branchSelect" required>
                            <option value="">-- اختر الفرع --</option>
                            @foreach($branches as $branch)
                            <option value="{{ $branch['id'] }}">{{ $branch['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">اسم المشروع <span class="required">*</span></label>
                        <input type="text" class="form-input" id="projectName" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">تاريخ العرض <span class="required">*</span></label>
                        <input type="date" class="form-input" id="quoteDate" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">صلاحية العرض (بالأيام)</label>
                    <input type="number" class="form-input" id="validityDays" value="28">
                    <small class="form-hint">العرض صالح لمدة 28 يوم افتراضياً</small>
                </div>

                <div class="form-group">
                    <label class="form-label">جهة الاتصال (اختياري)</label>
                    <input type="text" class="form-input" id="contactPerson">
                </div>
            </div>

            <div class="wizard-actions">
                <button class="btn btn--outline" disabled>السابق</button>
                <button class="btn btn--primary" id="step1Next">التالي</button>
            </div>
        </div>

        <!-- Step 2: Items & Pricing -->
        <div class="wizard-step" id="step2">
            <div class="form-card">
                <div class="form-card__header">
                    <h3 class="form-card__title">البنود والتسعير</h3>
                    <div class="form-card__actions">
                        <button class="btn btn--outline btn--sm" id="addItemBtn">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                            </svg>
                            إضافة بند
                        </button>
                        <button class="btn btn--outline btn--sm" id="templatesBtn">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                            </svg>
                            إضافة من قالب
                        </button>
                        <button class="btn btn--outline btn--sm" id="copyFromQuoteBtn">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"/>
                                <path d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z"/>
                            </svg>
                            نسخ من عرض سابق
                        </button>
                    </div>
                </div>

                <div class="items-table-wrapper">
                    <table class="items-table" id="itemsTable">
                        <thead>
                            <tr>
                                <th style="width: 40px;">#</th>
                                <th style="width: 150px;">نوع البند</th>
                                <th>الوصف</th>
                                <th style="width: 100px;">الكمية</th>
                                <th style="width: 120px;">سعر الوحدة</th>
                                <th style="width: 100px;">الخصم</th>
                                <th style="width: 100px;">الضريبة ٪</th>
                                <th style="width: 120px;">الإجمالي</th>
                                <th style="width: 100px;">إجراءات</th>
                            </tr>
                        </thead>
                        <tbody id="itemsTableBody">
                            <!-- Items will be added dynamically -->
                        </tbody>
                    </table>

                    <div class="empty-items" id="emptyItems">
                        <svg width="48" height="48" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                        </svg>
                        <p>لا توجد بنود بعد، اضغط "إضافة بند" للبدء</p>
                    </div>
                </div>

                <!-- Summary Box -->
                <div class="summary-box">
                    <div class="summary-row">
                        <span>المجموع الفرعي:</span>
                        <strong id="subtotalValue">0.00 ر.س</strong>
                    </div>
                    <div class="summary-row">
                        <span>الخصم:</span>
                        <strong id="discountValue">0.00 ر.س</strong>
                    </div>
                    <div class="summary-row">
                        <span>الضريبة (15%):</span>
                        <strong id="taxValue">0.00 ر.س</strong>
                    </div>
                    <div class="summary-row summary-row--total">
                        <span>الإجمالي النهائي:</span>
                        <strong id="totalValue">0.00 ر.س</strong>
                    </div>
                </div>
            </div>

            <div class="wizard-actions">
                <button class="btn btn--outline" id="step2Prev">السابق</button>
                <button class="btn btn--primary" id="step2Next">التالي</button>
            </div>
        </div>

        <!-- Step 3: Terms & Notes -->
        <div class="wizard-step" id="step3">
            <div class="form-card">
                <h3 class="form-card__title">الشروط والملاحظات</h3>

                <div class="form-group">
                    <label class="form-label">الشروط والأحكام</label>
                    <textarea class="form-input" id="terms" rows="6" placeholder="أدخل الشروط والأحكام...">1. يسري هذا العرض لمدة 28 يوم من تاريخه.
2. الأسعار شاملة ضريبة القيمة المضافة.
3. تخضع الأسعار للتغيير دون إشعار مسبق.
4. الدفع خلال 30 يوم من تاريخ الفاتورة.</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">ملاحظات داخلية <span class="internal-note">(لا تظهر للعميل)</span></label>
                    <textarea class="form-input" id="internalNotes" rows="4" placeholder="ملاحظات داخلية للفريق..."></textarea>
                </div>

                <div class="form-group">
                    <label class="checkbox-label">
                        <input type="checkbox" id="useBranchTerms">
                        <span>استخدام شروط الفرع الافتراضية</span>
                    </label>
                </div>

                <div class="form-group">
                    <label class="form-label">المرفقات (اختياري)</label>
                    <div class="upload-zone" id="uploadZone">
                        <svg width="48" height="48" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <h4>اسحب الملفات هنا أو اضغط للاختيار</h4>
                        <p>PDF, DOC, DOCX, JPG, PNG</p>
                        <input type="file" id="fileInput" style="display: none;" multiple>
                    </div>
                </div>
            </div>

            <div class="wizard-actions">
                <button class="btn btn--outline" id="step3Prev">السابق</button>
                <button class="btn btn--primary" id="step3Next">التالي</button>
            </div>
        </div>

        <!-- Step 4: Review & Send -->
        <div class="wizard-step" id="step4">
            <div class="review-section">
                <div class="review-card">
                    <h4>ملخص العميل والمشروع</h4>
                    <div class="review-grid">
                        <div class="review-item">
                            <span class="review-label">العميل:</span>
                            <span class="review-value" id="reviewCustomer">--</span>
                        </div>
                        <div class="review-item">
                            <span class="review-label">المشروع:</span>
                            <span class="review-value" id="reviewProject">--</span>
                        </div>
                        <div class="review-item">
                            <span class="review-label">الفرع:</span>
                            <span class="review-value" id="reviewBranch">--</span>
                        </div>
                        <div class="review-item">
                            <span class="review-label">تاريخ العرض:</span>
                            <span class="review-value" id="reviewDate">--</span>
                        </div>
                    </div>
                </div>

                <div class="review-card">
                    <h4>ملخص البنود</h4>
                    <div class="review-items" id="reviewItems">
                        <p class="review-empty">لا توجد بنود</p>
                    </div>
                </div>

                <div class="review-card">
                    <h4>الملخص المالي</h4>
                    <div class="financial-summary">
                        <div class="financial-row">
                            <span>المجموع الفرعي:</span>
                            <strong id="reviewSubtotal">0.00 ر.س</strong>
                        </div>
                        <div class="financial-row">
                            <span>الخصم:</span>
                            <strong id="reviewDiscount">0.00 ر.س</strong>
                        </div>
                        <div class="financial-row">
                            <span>الضريبة:</span>
                            <strong id="reviewTax">0.00 ر.س</strong>
                        </div>
                        <div class="financial-row financial-row--total">
                            <span>الإجمالي النهائي:</span>
                            <strong id="reviewTotal">0.00 ر.س</strong>
                        </div>
                    </div>
                </div>

                <div class="review-card">
                    <label class="checkbox-label checkbox-label--large">
                        <input type="checkbox" id="confirmCheckbox" required>
                        <span>أقرّ بأن جميع البيانات المدخلة صحيحة ومطابقة للواقع</span>
                    </label>
                </div>
            </div>

            <div class="wizard-actions">
                <button class="btn btn--outline" id="step4Prev">السابق</button>
                <button class="btn btn--primary" id="finalSubmitBtn">إرسال للاعتماد</button>
            </div>
        </div>

    </div>

    <!-- Quick Add Customer Modal -->
    <div class="modal" id="quickCustomerModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h3 class="modal__title">إضافة عميل سريع</h3>
                <button class="modal__close" aria-label="إغلاق">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            <div class="modal__body">
                <div class="form-group">
                    <label class="form-label">اسم العميل</label>
                    <input type="text" class="form-input" id="quickCustomerName">
                </div>
                <div class="form-group">
                    <label class="form-label">الهاتف</label>
                    <input type="tel" class="form-input" id="quickCustomerPhone">
                </div>
                <div class="form-group">
                    <label class="form-label">البريد الإلكتروني</label>
                    <input type="email" class="form-input" id="quickCustomerEmail">
                </div>
            </div>
            <div class="modal__footer">
                <button class="btn btn--outline modal__close">إلغاء</button>
                <button class="btn btn--primary" id="saveQuickCustomerBtn">حفظ</button>
            </div>
        </div>
    </div>

    <!-- PDF Preview Modal -->
    <div class="modal" id="pdfPreviewModal">
        <div class="modal__overlay"></div>
        <div class="modal__content modal__content--large">
            <div class="modal__header">
                <h3 class="modal__title">معاينة PDF</h3>
                <button class="modal__close" aria-label="إغلاق">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            <div class="modal__body">
                <div class="pdf-preview">
                    <div class="skeleton-box"></div>
                    <p>جارٍ تحميل المعاينة...</p>
                </div>
            </div>
            <div class="modal__footer">
                <button class="btn btn--outline modal__close">إغلاق</button>
                <button class="btn btn--primary">تحميل PDF</button>
            </div>
        </div>
    </div>

    <!-- Send for Approval Modal -->
    <div class="modal" id="approvalModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h3 class="modal__title">إرسال للاعتماد</h3>
                <button class="modal__close" aria-label="إغلاق">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            <div class="modal__body">
                <div class="form-group">
                    <label class="form-label">اختر المُعتمد</label>
                    <select class="form-input">
                        <option>محمد أحمد - مدير الفرع الرئيسي</option>
                        <option>سارة علي - المدير العام</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">ملاحظات للمُعتمد</label>
                    <textarea class="form-input" rows="3" placeholder="أضف ملاحظات إضافية..."></textarea>
                </div>
            </div>
            <div class="modal__footer">
                <button class="btn btn--outline modal__close">إلغاء</button>
                <button class="btn btn--primary" id="confirmApprovalBtn">تأكيد الإرسال</button>
            </div>
        </div>
    </div>

    <!-- Copy From Quote Modal -->
    <div class="modal" id="copyQuoteModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h3 class="modal__title">نسخ من عرض سابق</h3>
                <button class="modal__close" aria-label="إغلاق">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            <div class="modal__body">
                <div class="quotes-list">
                    @foreach($previousQuotes as $quote)
                    <label class="quote-option">
                        <input type="radio" name="copyQuote" value="{{ $quote['id'] }}">
                        <div class="quote-info">
                            <strong>{{ $quote['number'] }}</strong>
                            <span>{{ $quote['customer'] }} - {{ $quote['items_count'] }} بنود</span>
                        </div>
                    </label>
                    @endforeach
                </div>
            </div>
            <div class="modal__footer">
                <button class="btn btn--outline modal__close">إلغاء</button>
                <button class="btn btn--primary" id="confirmCopyBtn">نسخ البنود</button>
            </div>
        </div>
    </div>

    <!-- Templates Drawer -->
    <div class="drawer" id="templatesDrawer">
        <div class="drawer__overlay"></div>
        <div class="drawer__content">
            <div class="drawer__header">
                <h3 class="drawer__title">قوالب البنود</h3>
                <button class="drawer__close" aria-label="إغلاق">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            <div class="drawer__body">
                <div class="templates-search">
                    <input type="text" class="form-input" placeholder="ابحث عن قالب...">
                </div>
                <div class="templates-list">
                    @foreach($templates as $template)
                    <div class="template-item" data-template-id="{{ $template['id'] }}" data-template-name="{{ $template['name'] }}" data-template-type="{{ $template['type'] }}" data-template-price="{{ $template['price'] }}">
                        <div class="template-info">
                            <strong>{{ $template['name'] }}</strong>
                            <span>{{ $template['price'] }} ر.س</span>
                        </div>
                        <button class="btn btn--sm btn--primary add-template-btn">إضافة</button>
                    </div>
                    @endforeach
                </div>
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
@endsection



