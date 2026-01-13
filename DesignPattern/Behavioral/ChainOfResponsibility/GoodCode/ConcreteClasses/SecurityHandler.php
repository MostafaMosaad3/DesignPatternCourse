<?php

namespace DesignPatterns\ChainOfResponsibility\GoodCode\ConcreteClasses;

use DesignPatterns\ChainOfResponsibility\GoodCode\AbstractHandler;
use DesignPatterns\ChainOfResponsibility\GoodCode\Request;

class SecurityHandler extends AbstractHandler
{
    public function handle(Request $request): bool
    {
        // Check security
        if (isset($request->data['malicious'])) {
            return false; // Stop chain
        }

        // Pass to next handler
        return parent::handle($request);
    }

}

/**
 * ============================================
 * ADVANTAGES OF THIS APPROACH:
 * ============================================
 *
 * 1. EACH HANDLER SEPARATE:
 *    ✅ AuthenticationHandler: Only auth
 *    ✅ AuthorizationHandler: Only authz
 *    ✅ SecurityHandler: Only security
 *    ✅ Single Responsibility!
 *
 * 2. EASY TO ADD NEW HANDLER:
 *    ✅ Create RateLimitHandler
 *    ✅ Add to chain: ->setNext(rateLimit)
 *    ✅ No changes to existing handlers!
 *
 * 3. EASY TO REORDER:
 *    ✅ Want security first? Just change setNext() order
 *    ✅ No code changes in handlers
 *    ✅ Flexible!
 *
 * 4. EASY TO TEST:
 *    ✅ Test AuthenticationHandler alone
 *    ✅ Test AuthorizationHandler alone
 *    ✅ Test SecurityHandler alone
 *    ✅ Independent testing!
 *
 * 5. REUSABLE:
 *    ✅ Use AuthenticationHandler in different chains
 *    ✅ Use SecurityHandler elsewhere
 *    ✅ No duplication!
 *
 * 6. FOLLOWS OPEN/CLOSED:
 *    ✅ Add new handler without modifying existing
 *    ✅ Production code stays unchanged
 *
 * ============================================
 * COMPARISON: BAD vs GOOD
 * ============================================
 *
 * ADD RATE LIMITING:
 *
 * BAD CODE:
 * ❌ Modify handle() method
 * ❌ Add if statement
 * ❌ Risk breaking existing logic
 * ❌ Must test everything again
 *
 * GOOD CODE:
 * ✅ Create RateLimitHandler class
 * ✅ Add to chain: ->setNext(rateLimit)
 * ✅ No changes to existing handlers
 * ✅ Only test new handler
 *
 * REORDER CHECKS:
 *
 * BAD CODE:
 * ❌ Cut/paste code in handle()
 * ❌ Risk breaking logic
 * ❌ Must re-test everything
 *
 * GOOD CODE:
 * ✅ Change setNext() order
 * ✅ No code changes
 * ✅ Safe!
 *
 * TEST INDIVIDUAL CHECK:
 *
 * BAD CODE:
 * ❌ Can't test auth alone
 * ❌ Must test entire handle()
 * ❌ Complex setup
 *
 * GOOD CODE:
 * ✅ Test AuthenticationHandler alone
 * ✅ Simple unit test
 * ✅ No dependencies
 *
 * That's the power of Chain of Responsibility! 🚀
 */
